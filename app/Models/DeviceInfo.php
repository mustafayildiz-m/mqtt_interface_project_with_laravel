<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceInfo extends Model
{
    use HasFactory;

    public function device()
    {
        return $this->belongsTo(Device::class,'serial_no','serial_no');
    }
}
