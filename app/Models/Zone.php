<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    public function workspace()
    {
        return $this->belongsTo(WorkSpace::class);
    }

     function devices()
    {
        return $this->hasMany(Device::class, 'zone_id', 'id');
    }

}
