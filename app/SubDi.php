<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubDi extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_ar',
        'name_en',
        'parent',
        'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    /**
     * Scope a query to only include popular users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */



    public function childZone()
    {
        return $this->hasMany('App\Zone', 'parent', 'id');

    }
    public function zone()
    {
        return $this->belongsTo('App\Zone', 'parent', 'id');
        // return $this->belongsTo('App\UserAddress');     # Should work but not working
    }

    public function childZoneDeleted()
    {
        return $this->hasMany('App\Zone', 'parent', 'id');

    }
}
