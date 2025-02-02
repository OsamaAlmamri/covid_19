<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;


class CheckPoint extends Model
{
    use SoftDeletes;
    use LogsActivity;


    //
    protected $fillable = [
        'name', 'manager_id', 'zone_id', 'longitude', 'latitude', 'map_address', 'status', 'deleted_by', 'created_by',
    ];

    protected static $logAttributes = ['name', 'manager_id', 'zone_id','status', 'deleted_by'];

    public function zone()
    {
        return $this->belongsTo('App\Zone', 'zone_id', 'code');
        // return $this->belongsTo('App\UserAddress');     # Should work but not working
    }

    public function workTeams()
    {
        return $this->belongsToMany('App\WorkTeam', 'point_teams', 'check_point_id', 'work_team_id')->orderByDesc('id');
    }

}
