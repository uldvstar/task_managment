<?php

namespace App\Models;

use App\Models\AbstractModel as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


/**
 * Class Task
 * @package App\Models
 * @version May 5, 2020, 8:40 am
 *
 * @property \App\Models\ProjectMilestone projectMilestone
 * @property \App\Models\ModularType modularType
 * @property \App\Models\ModularType modularType1
 * @property int milestone_id
 * @property int type_id
 * @property string title
 * @property string description
 * @property int status
 * @property boolean active
 */
class Task extends AbstractModel
{

    use SoftDeletes;


    protected $table = 'tasks';

    
    
    protected $dates = ['deleted_at'];

    

    public $fillable = [
        'milestone_id',
        'type_id',
        'title',
        'description',
        'status',
        'active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'active' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type_id' => 'required',
        'title' => 'required',
        'status' => 'required'
    ];


    public function departments() {
        return $this->morphedByMany(Department::class, 'assignee', 'task_assignees', 'assignment_id');
    }

    public function users() {
        return $this->morphedByMany(User::class,'assignee', 'task_assignees', 'assignment_id');
    }

    public function trackers()
    {
        return $this->morphToMany(User::class, 'trackable', 'time_trackers')->withPivot('time_start', 'time_end');
    }

    public function comments()
    {
        return $this->morphToMany(User::class, 'commentable', 'comments')->withPivot('id', 'comment', 'created_at');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function milestone(): BelongsTo
    {
        return $this->BelongsTo(ProjectMilestone::class, 'milestone_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function taskType(): BelongsTo
    {
        return $this->BelongsTo(ModularType::class, 'type_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function currentStatus(): BelongsTo
    {
        return $this->BelongsTo(ModularType::class, 'status', 'id')->withTrashed();
    }


}
