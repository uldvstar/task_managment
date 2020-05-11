<?php

namespace App\Models;

use App\Models\AbstractModel as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Project
 * @package App\Models
 * @version May 5, 2020, 3:19 am
 *
 * @property ModularType modularTypes
 * @property Client client
 * @property ModularType modularTypes1
 * @property int type_id
 * @property int client_id
 * @property string reference
 * @property string description
 * @property int status
 */
class Project extends AbstractModel
{

    use SoftDeletes;


    protected $table = 'projects';

    
    
    protected $dates = ['deleted_at'];

    

    public $fillable = [
        'type_id',
        'client_id',
        'reference',
        'description',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'reference' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type_id' => 'required',
        'client_id' => 'required',
        'reference' => 'required',
        'status' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function projectType(): BelongsTo
    {
        return $this->BelongsTo(ModularType::class, 'type_id', 'id')->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function client(): BelongsTo
    {
        return $this->BelongsTo(Client::class, 'client_id', 'id')->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function currentStatus(): BelongsTo
    {
        return $this->BelongsTo(ModularType::class, 'status', 'id')->withTrashed();
    }


    public function milestones(): hasMany
    {
        return $this->hasMany(ProjectMilestone::class, 'project_id', 'id');
    }

    public function tasks(): hasManyThrough {
        return $this->hasManyThrough(Task::class, ProjectMilestone::class, 'project_id', 'milestone_id');
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function($project) {
            foreach($project->milestones as $milestone){
                $milestone->delete();
            }
        });
    }

}
