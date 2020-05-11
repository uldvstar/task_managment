<?php

namespace App\Models;

use App\Models\AbstractModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class TaskAssignee
 * @package App\Models
 * @version May 8, 2020, 12:20 am
 *
 * @property int assignee_id
 * @property string assignee_type
 * @property int assignment_id
 */
class TaskAssignee extends AbstractModel
{

    use SoftDeletes;


    protected $table = 'task_assignees';

    
    
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
