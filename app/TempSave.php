<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempSave extends Model
{
    //data,user_id,team_work_id,isReadSave
    protected $fillable = [
        'data', 'user_id', 'team_work_id', 'isReadSave'
    ];
}
