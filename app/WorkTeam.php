<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkTeam extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'name', 'zone_id',
        'phone', 'ssn', 'workType',
        'job', 'birth_date', 'gender',
        'join_date', 'country',
        'deleted_by', 'created_by',
    ];
}
