<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\Location;
use App\Models\Unit;

class LocationController extends Controller
{
    //this function get latest data of Location from WSS API and update local database
    public function getLocationDataAPI($location_number){
        $token = '5a5042a0-2c6e-4b8c-8d8a-0bc33470a9ad';
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token, // Include the token in the Authorization header
            'Accept' => 'application/json',       // Optional, ensures the response is in JSON format
        ])->get('https://api.webselfstorage.com/v3/location/' . $location_number);
    
        if ($response->successful()) {
            $location_data = $response->json();
            $units_json = $location_data['location']['units'];
            $this->updateUnitsInLocalDB($units_json, $location_number);
            return $location_data;
        }
    
        // Handle API errors
        return [
            'error' => true,
            'message' => $response->body(),
        ];
    }

    public function updateUnitsInLocalDB($json_units, $location_number){
        // Fetch all current database unit keys
        $db_units = DB::table('units')->pluck('unit_key')->toArray();

        // Extract unit keys from the JSON data
        $json_unit_keys = array_column($json_units, 'unitId');

        // Find unit keys to delete (exist in DB but not in JSON)
        $keys_to_delete = array_diff($db_units, $json_unit_keys);

        // Find unit keys to insert (exist in JSON but not in DB)
        $keys_to_insert = array_diff($json_unit_keys, $db_units);
        // Delete records from the database
        if (!empty($keys_to_delete)) {
            DB::table('units')->whereIn('unit_key', $keys_to_delete)->delete();
        }

        // Insert new records into the database
        foreach ($json_units as $unit) {
            if (in_array($unit['unitId'], $keys_to_insert)) {
                //insertion required in wp_post table because loop grid (Elementor) only get data from Post
                //insert a post with post type Unit and then put this post_id to Unit table

                $post_id = DB::table('wp_posts')->insertGetId([
                    'post_author' => Auth::id(),
                    'post_date' => now(),
                    'post_date_gmt' => now(), 
                    'post_content' => '',
                    'post_title' => $unit['unitSize'],
                    'post_excerpt' => '',
                    'post_status' => 'publish',
                    'comment_status' => '',
                    'ping_status' => '',
                    'post_password' => '',
                    'post_name' => '',
                    'to_ping' => '',
                    'pinged' => '',
                    'post_modified' => now(),
                    'post_modified_gmt' => now(),
                    'post_content_filtered' => '',
                    'post_parent' => 0,
                    'guid' => '',
                    'menu_order' => 0, 
                    'post_type' => 'unit',
                    'post_mime_type' => '',
                    'comment_count' => 0
                ]);

                DB::table('units')->insert([
                    'location_number' => $location_number,
                    'rent_per_month' => 0,
                    'unit_key' => $unit['unitId'],
                    'unit_size' => $unit['unitSize'],
                    'post_id' => $post_id,
                    'unit_features' => [],
                    'enable' => true,
                    'created_by' => Auth::id(),
                    'updated_by' => Auth::id(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function getFullAddress($location_api_data){
        $full_address = $location_api_data['location']['address']['addressLine1'];
        $full_address .= ' ' . $location_api_data['location']['address']['addressLine2'];
        $full_address .= ' ' . $location_api_data['location']['address']['city'];
        $full_address .= ' ' . $location_api_data['location']['address']['country'];
        return $full_address;
    }

    //locaiton number is default set to 1038525
    public function locationDetail($location_number = 1038525){
        $location = Location::find(1);//getting location id 1 in local db which is current set on 1038525
        $location_api_data = $this->getLocationDataAPI($location_number);
        
        $features = $location_api_data['location']['locationFeatures'];
        $location_data = (object) [
            'location_id' => $location->location_id,
            'enable' => $location->enable,
            'location_number' => $location->location_number,
            'name' => $location_api_data['location']['name'],
            'phone' => $location_api_data['location']['phone'],
            'address' => $this->getFullAddress($location_api_data),
            'latitude' => $location_api_data['location']['address']['location']['latitude'],
            'longitude' => $location_api_data['location']['address']['location']['longitude'],
            'features' => $features,
        ];
        return view ('location-detail', compact('location_data'));
    }

    public function getFeatures($features){

    }

    public function setActivateStatus(Request $request){
        try{
            $message = 'Location status update';
            $status = true;

            $location = Location::find($request->id);
            if ($location){
                $location->enable = $request->enabled;
                $location->last_updated_by_id = Auth::id();
                $location->updated_datetime = now(); 
                $location->save();
            }
            else{
                $status = false;
                $message = 'Location ' . $request->id . 'not found';
            }

            return response()->json([
                'success' => $status,
                'message' => $message,
            ]);
        } catch (Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'some error occured',
            ]);
        }
        
    }
}