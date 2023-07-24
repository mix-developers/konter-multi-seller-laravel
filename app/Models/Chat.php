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
    public function user_from(): BelongsTo
    {
        return $this->belongsTo(User::class, 'from_user', 'id');
    }
    public function user_to(): BelongsTo
    {
        return $this->belongsTo(User::class, 'to_user', 'id');
    }
    public static function getNotification($id_user)
    {
        return self::with(['user_from', 'user_to'])->where('to_user', $id_user)->latest()->take(5)->get();
    }
}
