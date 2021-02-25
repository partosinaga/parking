<?php

namespace App\Exports;

use App\Models\Parking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ParkingExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = Parking::select(
            'vehicle_no',
            'parking_code',
            'time_in',
            'time_out',
            'rate',
            'duration',
            'cost',
            'created_by',
        )->whereNotNull('time_out');
        return $data->get();
    }

    public function headings(): array
    {
        return ['VEHICLE', 'CODE', 'IN', 'OUT', 'RATE', 'DURATION', 'COST', 'CREATED BY'];
    }
}
