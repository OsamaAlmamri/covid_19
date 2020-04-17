<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use HasRoles;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'email', 'password', 'username', 'avatar', 'work_team_id', 'status', 'deleted_by', 'created_by',
    ];
//'App\\Student',
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function manages()
    {
        return $this->hasMany('App\Project', 'manager_id', 'id');
    }

    public function tasks()
    {
        return $this->hasMany('App\Task', 'user_id', 'id');
    }


    public function projects()
    {
        return $this->belongsToMany('App\Project', 'project_users', 'user_id', 'project_id')->orderByDesc('id');
    }


}
