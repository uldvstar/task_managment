<?php

namespace App\Models;

use App\Models\AbstractModel as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Client
 * @package App\Models
 * @version May 5, 2020, 12:18 am
 *
 * @property int type_id
 * @property string marking
 * @property string name
 * @property string email
 * @property string wechat_id
 */
class Client extends AbstractModel
{

    use SoftDeletes;


    protected $table = 'clients';

    
    
    protected $dates = ['deleted_at'];

    

    public $fillable = [
        'type_id',
        'marking',
        'name',
        'email',
        'wechat_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'marking' => 'string',
        'name' => 'string',
        'email' => 'string',
        'wechat_id' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type_id' => 'required',
        'marking' => 'required',
        'name' => 'required',
        'email' => 'required|email'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function CustomerType(): BelongsTo
    {
        return $this->BelongsTo(ModularType::class, 'type_id', 'id')->withTrashed();
    }

}
