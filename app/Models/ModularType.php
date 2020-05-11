<?php

namespace App\Models;

use App\Models\AbstractModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class ModularType
 * @package App\Models
 * @version May 4, 2020, 10:25 pm
 *
 * @property integer module_type
 * @property string name
 * @property string reference
 * @property string description
 */
class ModularType extends AbstractModel
{

    use SoftDeletes;


    protected $table = 'modular_types';

    
    
    protected $dates = ['deleted_at'];

    

    public $fillable = [
        'module_type',
        'name',
        'reference',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'module_type' => 'integer',
        'name' => 'string',
        'reference' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'module_type' => 'required',
        'name' => 'required'
    ];

    

}
