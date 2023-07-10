<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Service extends Model
{
    use HasFactory;
    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class, 'id_layanan');
    }
    public function konter(): BelongsTo
    {
        return $this->belongsTo(Konter::class, 'id_konter');
    }
    public static function getAll()
    {
        return self::with(['pelanggan', 'layanan', 'konter'])->get();
    }
    public static function getNotif()
    {
        return self::with(['pelanggan', 'layanan', 'konter'])->where('id_user', Auth::user()->id)
            ->take(3)
            ->get();
    }
    public static function getServiceUser()
    {
        return self::with(['pelanggan', 'layanan', 'konter'])->where('id_user', Auth::user()->id)->get();
    }
}
