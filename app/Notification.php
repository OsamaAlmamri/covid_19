<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $fillable = [
        // 'title','notification','file','admin_id'
        'id', 'type', 'notifiable_id', 'notifiable_type', 'data', 'read_at',
    ];


    public function admin()
    {
        return $this->belongsTo('App\Admin');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function customer()
    {
        return $this->belongsToMany('App\Customer');
    }
}
