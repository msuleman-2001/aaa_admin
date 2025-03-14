<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Unit;

class UnitController extends Controller
{
    public function unitList(){
        $path = storage_path('app\unitRes.json');
        $file_content = file_get_contents($path);
        $json_content = json_decode($file_content, true);

        $location_number = "1038525";
        // $token = '5a5042a0-2c6e-4b8c-8d8a-0bc33470a9ad';
        // $location_number = "1038525";
        // $response = Http::withHeaders([
        //     'Authorization' => 'Bearer ' . $token, // Include the token in the Authorization header
        //     'Accept' => 'application/json',        // Optional, ensures the response is in JSON format
        // ])->get('https://api.webselfstorage.com/v3/movein/' . $location_number);
    
        // if ($response->successful()) 
        //     $json_content = $response->json();
            
        
        $unit_json = $json_content;
        $available_units = $unit_json['availableUnits'];
        
        $this->updateUnitsInLocalDB($available_units, $location_number);
        
        $locations = Location::all();
        $location_number = $locations->first()->location_number;
        $units = Unit::where('location_number', $location_number)->get();
        return view ('unit-list', compact('locations', 'units'));
    }

    public function updateUnitsInLocalDB($json_units, $location_number){
        // Fetch all current database unit keys
        $db_units = DB::table('units')->pluck('unit_key')->toArray();
        
        // Extract unit keys from the JSON data
        $json_unit_keys = array_column($json_units, 'rentableObjectId');
        
        // Find unit keys to delete (exist in DB  but not in JSON)
        $keys_to_delete = array_diff($db_units, $json_unit_keys);
        
        // Find unit keys to insert (exist in JSON but not in DB)
        $keys_to_insert = array_diff($json_unit_keys, $db_units);
        
        // Delete records from the database
        if (!empty($keys_to_delete)) {
            DB::table('units')->whereIn('unit_key', $keys_to_delete)->delete();
        }
        
        // Insert new records into the database
        foreach ($json_units as $unit) {
            
            if (in_array($unit['rentableObjectId'], $keys_to_insert)) {
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
                    'rent_per_month' => $unit['monthly'],
                    'insurance_options' => $this->replaceFlood(json_encode($unit['insuranceOptions'])),
                    'unit_key' => $unit['rentableObjectId'],
                    'unit_size' => $unit['unitSize'],
                    'post_id' => $post_id,
                    'enable' => true,
                    'created_by' => Auth::id(),
                    'updated_by' => Auth::id(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function replaceFlood($insuranceOptions){
        $insuranceOptions = str_replace("Flood", "Tenant", $insuranceOptions);
        return $insuranceOptions;
    }

    public function updateUnit(Request $request){
        try{
            $message = 'Unit updated';
            $status = true;

            $unit = Unit::find($request->unit_id);

            if ($unit){
                $unit->old_rate = $request->rent_per_month;
                $coupons = explode("\n", trim($request->coupons)); // Split input into lines
                $selected_index = $request->selected_coupon_index ? $request->selected_coupon_index : -1;
                
                $coupon_json = [];
                $index = 0;
                foreach ($coupons as $coupon) {
                    $parts = array_map('trim', explode(',', $coupon, 2)); // Split by comma and trim spaces

                    if (count($parts) === 2) {
                        $index++;
                        $coupon_json[] = [
                            "couponName" => $parts[0],
                            "couponValue" => $parts[1],
                            "selected" => $index == $selected_index ? "1" : "0"
                        ];
                    }
                }
                $unit->coupons_data = json_encode($coupon_json, true);
                $unit->unit_features = json_encode(explode("\n", trim($request->features)));
                $unit->updated_by = Auth::id();
                $unit->updated_at = now();
                $unit->save();
            }
            else{
                $status = false;
                $message = 'Unit not found';
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

    public function unitDetail($unit_id = 1){
        $unit = Unit::find($unit_id);
        return view ('unit-detail', compact('unit'));
    }

    public function setActivateStatus(Request $request){
        try{
            $message = 'Unit status update';
            $status = true;

            $unit = Unit::find($request->unit_id);

            if ($unit){
                $unit->enable = $request->enable;
                $unit->updated_by = Auth::id();
                $unit->updated_at = now();
                $unit->save();
            }
            else{
                $status = false;
                $message = 'Unit not found';
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