<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_space_id',
        'parent_id',
        'name',
    ];

    public function workspace()
    {
        return $this->belongsTo(WorkSpace::class);
    }

    function devices()
    {
        return $this->hasMany(Device::class, 'zone_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Zone::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Zone::class, 'parent_id');
    }

    // Ağaç yapısında sıralama
    // Ağaç yapısında sıralama
    public static function getTree($workspaceId = 1, $parentId = null, $depth = 0)
    {
        $zones = static::where('work_space_id', $workspaceId)
            ->where('parent_id', $parentId)
            ->orderBy('name')
            ->get();

        $tree = [];

        foreach ($zones as $zone) {
            $zone->depth = $depth;
            $tree[] = $zone;
            $tree = array_merge($tree, static::getTree($workspaceId, $zone->id, $depth + 1));
        }

        return $tree;
    }

}
