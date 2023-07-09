<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Konter extends Model
{
    use HasFactory;
    protected $table = 'konter';
    protected $guarded = [];

    public function pemilik(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_pemilik');
    }
    public static function getAll()
    {
        return self::with(['pemilik'])->get();
    }
    public static function getListFront()
    {
        return self::with(['pemilik'])->paginate(10);
    }

    public static function getHome()
    {
        return self::with(['pemilik'])->take(3)->get();
    }
}
