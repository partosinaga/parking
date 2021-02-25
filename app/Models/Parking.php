<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    use HasFactory;

    protected $table = 'parking';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'vehicle_no',
        'parking_code',
        'time_in',
        'time_out',
        'rate'
    ];
}
