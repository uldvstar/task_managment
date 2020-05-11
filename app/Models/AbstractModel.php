<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class AbstractModel extends Model
{
    use LogsActivity;
    protected static $logFillable  = true;
}