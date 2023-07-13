<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat extends Model
{
    use HasFactory;
    protected $table = 'chat';
    protected $guarded = [];
    public function from_user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'from_user');
    }
    public function to_user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'to_user');
    }
}
