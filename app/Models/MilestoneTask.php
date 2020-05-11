<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class MilestoneTask
 * @package App\Models
 * @version May 5, 2020, 8:36 am
 *
 * @property \App\Models\Milestone milestone
 * @property \App\Models\ModularType modularType
 * @property int milestone_id
 * @property int type_id
 * @property string title
 * @property string description
 */
class MilestoneTask extends AbstractModel
{

    use SoftDeletes;


    protected $table = 'milestone_tasks';

    
    
    protected $dates = ['deleted_at'];

    

    public $fillable = [
        'milestone_id',
        'type_id',
        'title',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'milestone_id' => 'required',
        'type_id' => 'required',
        'title' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function milestone(): BelongsTo
    {
        return $this->BelongsTo(Milestone::class, 'milestone_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function taskType(): BelongsTo
    {
        return $this->BelongsTo(ModularType::class, 'type_id', 'id');
    }

    public function departments(){
        return $this->morphedByMany(Department::class, 'assignee', 'milestone_task_assignees', 'assignment_id');
    }

    public function users(){
        return $this->morphedByMany(User::class,'assignee', 'milestone_task_assignees', 'assignment_id');
    }



}
