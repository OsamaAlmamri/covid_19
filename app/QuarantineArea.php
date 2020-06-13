<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class QuarantineArea extends Model
{
    //
    use SoftDeletes;
    use LogsActivity;

    protected $fillable = [
        'name', 'quarantine_area_type_id', 'manager_id',
        'zone_id', 'longitude', 'latitude', 'map_address',
        'status', 'maxCapacity', 'deleted_by', 'created_by',
    ];
    protected static $logAttributes = ['name', 'quarantine_area_type_id', 'manager_id',
        'zone_id','status', 'maxCapacity', 'deleted_by'];

    public function zone()
    {
        return $this->belongsTo('App\Zone', 'zone_id', 'code');
        // return $this->belongsTo('App\UserAddress');     # Should work but not working
    }

    public function workTeams()
    {
        return $this->belongsToMany('App\WorkTeam', 'health_teams', 'quarantine_area_id', 'work_team_id')->orderByDesc('id');
    }
}
