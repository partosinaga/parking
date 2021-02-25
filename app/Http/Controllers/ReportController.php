<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parking;
use App\Models\Rate;
use DateTime;
use App\Exports\ParkingExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function report()
    {
        $rate = Rate::select('rate')->first();
        $data = Parking::whereNotNull('time_out')
            ->orderBy('time_out', 'desc')
            ->paginate(env('PAGE'));
        return view('report.index', compact('rate', 'data'));
    }

    public function actionReport(Request $request)
    {
        $from = date('Y-m-d', strtotime($request->from)). ' 00:00:00';
        $to = date('Y-m-d', strtotime($request->to)). ' 23:59:59';

        $rate = Rate::select('rate')->first();
        $data = Parking::whereNotNull('time_out')
            ->where($request->filter_by, '>=', $from)
            ->where($request->filter_by, '<=', $to)
            ->orderBy('time_out', 'desc')
            ->paginate(env('PAGE'));
        
        if($request->action == 'export')
        {
            return $this->export($data);
        }
        return view('report.index', compact('rate', 'data'));
    }



    public function export()
    {
        return Excel::download(new ParkingExport(), 'parking-report-'.date('Ymd').'.xlsx');
    }
}
