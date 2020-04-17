<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckPoint extends Model
{
    use SoftDeletes;

    //
    protected $fillable = [
        'name', 'manager_id', 'zone_id', 'longitude', 'latitude', 'map_address', 'status', 'deleted_by', 'created_by',
    ];
}
