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
            $message = 'Rent updated';
            $status = true;

            $unit = Unit::find($request->unit_id);

            if ($unit){
                $unit->old_rate = $unit->rent_per_month;
                $unit->rent_per_month = $request->rent_per_month;
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