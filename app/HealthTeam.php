<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HealthTeam extends Model
{
    //

    protected $fillable = [
        'work_team_id', 'quarantine_area_id'
    ];
}
