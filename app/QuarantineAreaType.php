<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class QuarantineAreaType extends Model
{
    //
    use LogsActivity;
    protected static $logAttributes = ['name'];
    protected $fillable = [
        'name'
    ];
}
