<?php

namespace App\Models;

use App\Models\AbstractModel as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Comment
 * @package App\Models
 * @version May 11, 2020, 9:13 am
 *
 * @property \App\Models\User user
 * @property int commentable_id
 * @property string commentable_type
 * @property int user_id
 * @property string|\Carbon\Carbon comment
 */
class Comment extends AbstractModel
{

    use SoftDeletes;


    protected $table = 'comments';

    
    
    protected $dates = ['deleted_at'];

    

    public $fillable = [
        'commentable_id',
        'commentable_type',
        'user_id',
        'comment'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'commentable_type' => 'string',
        'comment' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    public function tasks()
    {
        return $this->morphedByMany(Task::class, 'commentable');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'user_id', 'id');
    }

}
