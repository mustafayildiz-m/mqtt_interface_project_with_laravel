<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    function deviceinfo()
    {
        return $this->hasMany(DeviceInfo::class, 'serial_no', 'serial_no');

    }

    function devicelog()
    {
        return $this->hasMany(DeviceLog::class, 'serial_no', 'serial_no');

    }

    function zone()
    {
        return $this->belongsTo(Zone::class, 'id', 'zone_id');
    }
}
