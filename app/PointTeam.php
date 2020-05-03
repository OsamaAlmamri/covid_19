<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class PointTeam extends Model
{
    //
//$table->unsignedBigInteger('work_team_id');
//$table->unsignedBigInteger('check_point_id');
    use LogsActivity;

    protected $fillable = [
        'work_team_id', 'check_point_id'
    ];
    protected static $logAttributes = ['work_team_id', 'check_point_id'];

}
