<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parking;
use App\Models\Rate;
use DateTime;
use DB;
class ParkingController extends Controller
{
    public function parkIn(Request $request)
    {
        try {
            DB::beginTransaction();

            $parkingCode = strtoupper($request->middle.$request->suffix.rand());
            $parkingCode = substr($parkingCode,0, 10);
            $vehicleNo = $request->prefix.' '.$request->middle.' '.$request->suffix;
            $checkExist = Parking::where('vehicle_no', $vehicleNo)->whereNull('time_out')->first();
            if($checkExist != null)
            {
                return [
                    'success' => false,
                    'data' => strtoupper($vehicleNo) .' not out yet since '.$checkExist->time_in
                ];
            };
            
            $rate = Rate::select('rate')->first();

            $in = new Parking;
            $in->vehicle_no = strtoupper($vehicleNo);
            $in->parking_code = $parkingCode;
            $in->time_in = date('Y-m-d H:i:s');
            $in->time_out = NULL;
            $in->created_by = \Auth::user()->name;
            $in->rate = $rate['rate'];
            $in->save();

            DB::commit();
            
            return [
                'success' => true,
                'data' => $in
            ];
        }catch(\Exception $e) {
            DB::rollBack();
            return [
                'success' => false,
                'data' => 'failed'
            ];
        }
    }

    public function out()
    {
        $rate = Rate::select('rate')->first();
        $recently = Parking::whereNull('time_out')->orderBy('id', 'desc')->paginate(env('PAGE'));
        return view('parking.out', compact('rate', 'recently'));
    }

    public function parkOut(Request $request)
    {
        $now = date('Y-m-d H:i:s');
        $costDay = 0;
        $costHour = 0;
        $costMinute = 0;
        $rate = Rate::select('rate')->first();
        $out = Parking::where('parking_code', $request->parking_code)->first();
        if($out == null)
        {
            return [
                'success' => false,
                'data' => $request->parking_code.' not found!'
            ];
        }

        if($out->time_out != null)
        {
            return [
                'success' => false,
                'data' => $request->parking_code .' has been out on '.$out->time_out
            ];
        }

        $timeIn = new DateTime($out->time_in);
        $timeOut = new DateTime($now);
        $out->time_out = $now;
        $out->save();

        $diff = $timeIn->diff($timeOut);
        $duration = $diff->format('%a Day, %h Hours %i Minutes %s Seconds');
        $day = $diff->format('%a');
        $hour = $diff->format('%h');
        $minute = $diff->format('%i');

        if($day > 0)
        {
            $costDay = ($day*24) * $rate->rate; 
        }
        if($hour > 0)
        {
            $costHour = $hour * $rate->rate; 
        }
        if($minute > 0)
        {
            $costMinute = $rate->rate; 
        }
        $cost = $costDay+$costHour+$costMinute;

        $timeIn = new DateTime($out->time_in);
        $timeOut = new DateTime($now);
        $out->time_out = $now;
        $out->duration = $duration;
        $out->cost = $cost;
        $out->save();

        return [
            'success' => true,
            'data' => [
                'in' => $out,
                'duration' => $duration,
                'cost' => $cost
            ],
        ];
    }   
}


