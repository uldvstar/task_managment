<?php

namespace App\Models;

use App\Models\AbstractModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class MilestoneTaskAssignee
 * @package App\Models
 * @version May 7, 2020, 6:31 pm
 *
 * @property int assignee_id
 * @property string assignee_type
 * @property int assignment_id
 */
class MilestoneTaskAssignee extends AbstractModel
{

    use SoftDeletes;


    protected $table = 'milestone_task_assignees';

    
    
    protected $dates = ['deleted_at'];

    

    public $fillable = [
        'assignee_id',
        'assignee_type',
        'assignment_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'assignee_type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'assignee_id' => 'required',
        'assignee_type' => 'required',
        'assignment_id' => 'required'
    ];

    public function departments()
    {
        return $this->morphedByMany(Department::class, 'assignee');
    }

    public function users()
    {
        return $this->morphedByMany(User::class, 'assignee');
    }

    

}
