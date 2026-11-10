<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vehiculos extends Model
{
    protected $table = 'vehiculos';

    protected $fillable = [
        'plate_number',
        'brand',
        'model',
        'vehicle_type',
        'color',
        'capacity',
        'daily_rate',
        'status'
    ];
}

