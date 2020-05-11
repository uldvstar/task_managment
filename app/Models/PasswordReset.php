<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PasswordReset extends AbstractModel
{
    protected $table = 'password_resets';

    protected $fillable = [
        'user_id', 'token', 'is_expired', 'is_complete'
    ];

    public function scopeActive($query){
        return $query->where('is_expired', false)->where('is_complete', false);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
