<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class HealthTeam extends Model
{
    //
    use LogsActivity;

    protected $fillable = [
        'work_team_id', 'quarantine_area_id'
    ];
    protected static $logAttributes = ['work_team_id', 'quarantine_area_id'];

}
