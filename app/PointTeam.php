<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PointTeam extends Model
{
    //
//$table->unsignedBigInteger('work_team_id');
//$table->unsignedBigInteger('check_point_id');

    protected $fillable = [
        'work_team_id', 'check_point_id'
    ];
}
