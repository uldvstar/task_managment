<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Milestone
 * @package App\Models
 * @version May 5, 2020, 8:20 am
 *
 * @property \App\Models\ModularType modularType
 * @property int project_type
 * @property string name
 * @property integer order
 */
class Milestone extends AbstractModel implements Sortable
{

    use SortableTrait;

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    use SoftDeletes;


    protected $table = 'milestones';

    
    
    protected $dates = ['deleted_at'];

    

    public $fillable = [
        'project_type',
        'name',
        'order'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'order' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'project_type' => 'required',
        'name' => 'required'
    ];

    public function buildSortQuery()
    {
        return static::query()->where('project_type', $this->project_type);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function businessService(): BelongsTo
    {
        return $this->BelongsTo(ModularType::class, 'project_type', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function tasks(): HasMany
    {
        return $this->HasMany(MilestoneTask::class, 'milestone_id', 'id');
    }

}
