<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkTeam extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'name', 'zone_id', 'phone', 'ssn', 'workType', 'job', 'birth_date',
        'gender', 'join_date', 'country', 'deleted_by', 'created_by',
    ];

    public function zone()
    {
        return $this->belongsTo('App\Zone', 'zone_id', 'id');
        // return $this->belongsTo('App\UserAddress');     # Should work but not working
    }


    public function user()
    {
        return $this->hasOne('App\User', 'work_team_id', 'id');
        // return $this->belongsTo('App\UserAddress');     # Should work but not working
    }

    public function quarantine_areas()
    {
        return $this->belongsToMany('App\QuarantineArea', 'health_teams', 'quarantine_area_id', 'work_team_id')->orderByDesc('id');
    }
    public function check_points()
    {
        return $this->belongsToMany('App\CheckPoint', 'point_teams', 'work_team_id', 'check_point_id')->orderByDesc('id');
    }


}
