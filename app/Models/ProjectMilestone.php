<?php

namespace App\Models;

use App\Models\AbstractModel as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class ProjectMilestone
 * @package App\Models
 * @version May 5, 2020, 8:39 am
 *
 * @property \App\Models\Project project
 * @property int project_id
 * @property string name
 * @property integer order
 * @property boolean complete
 */
class ProjectMilestone extends AbstractModel
{

    use SoftDeletes;


    protected $table = 'project_milestones';

    
    
    protected $dates = ['deleted_at'];

    

    public $fillable = [
        'project_id',
        'name',
        'order',
        'complete'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'order' => 'integer',
        'complete' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'project_id' => 'required',
        'name' => 'required'
    ];

    public function buildSortQuery()
    {
        return static::query()->where('project_id', $this->project_id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function project(): BelongsTo
    {
        return $this->BelongsTo(Project::class, 'project_id', 'id');
    }

    public function tasks(): hasMany
    {
        return $this->hasMany(Task::class, 'milestone_id', 'id');
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function($milestone) {
            foreach($milestone->tasks as $task){
                $task->delete();
            }
        });
    }

}
