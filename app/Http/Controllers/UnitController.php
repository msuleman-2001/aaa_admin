<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Unit;

class UnitController extends Controller
{
    public function unitList(){
        $locations = Location::all();
        $location_number = $locations->first()->location_number;
        $units = Unit::where('location_number', $location_number)->get();
        return view ('unit-list', compact('locations', 'units'));
    }

    public function updateUnit(Request $request){
        try{
            $message = 'Unit updated';
            $status = true;

            $unit = Unit::find($request->unit_id);

            if ($unit){
                $unit->old_rate = $unit->rent_per_month;
                $unit->rent_per_month = $request->rent_per_month;
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