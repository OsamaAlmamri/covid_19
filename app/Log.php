<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    //
    protected $fillable = [
        'member_id', 'name',  'type', 'description', 'user_id'
    ];

}
