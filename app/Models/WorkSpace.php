<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkSpace extends Model
{

    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function zones()
    {
        return $this->hasMany(Zone::class);

    }
}
