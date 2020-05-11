<?php

namespace App\Models;

use App\Models\AbstractModel as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Department
 * @package App\Models
 * @version May 5, 2020, 1:02 am
 *
 * @property \App\Models\User user
 * @property string name
 * @property string description
 * @property int head_id
 */
class Department extends AbstractModel
{

    use SoftDeletes;


    protected $table = 'departments';

    
    
    protected $dates = ['deleted_at'];

    

    public $fillable = [
        'name',
        'description',
        'head_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function manager(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'head_id', 'id');
    }


}
