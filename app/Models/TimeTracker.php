<?php

namespace App\Models;

use App\Models\AbstractModel as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class TimeTracker
 * @package App\Models
 * @version May 11, 2020, 2:57 am
 *
 * @property \App\Models\User user
 * @property int trackable_id
 * @property string trackable_type
 * @property int user_id
 * @property string|\Carbon\Carbon time_start
 * @property string|\Carbon\Carbon time_end
 */
class TimeTracker extends AbstractModel
{

    use SoftDeletes;


    protected $table = 'time_trackers';

    
    
    protected $dates = ['deleted_at'];

    

    public $fillable = [
        'trackable_id',
        'trackable_type',
        'user_id',
        'time_start',
        'time_end'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'trackable_type' => 'string',
        'time_start' => 'datetime',
        'time_end' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function tasks()
    {
        return $this->morphedByMany(Task::class, 'trackable');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'user_id', 'id');
    }

}
