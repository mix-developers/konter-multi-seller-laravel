<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat extends Model
{
    use HasFactory;
    protected $table = 'chats';
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public static function getNotif($user_id)
    {
        $room = self::where('user_id', $user_id)->latest()->first();
        return self::where('user_id', '!=', $user_id)->where('chat_room_id', $room->chat_room_id)->latest()->first();
    }
}
