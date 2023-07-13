<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;
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
        return self::with(['pelanggan', 'layanan', 'konter'])->withTrashed()->get();
    }
    public static function getNotif()
    {

        return self::with(['pelanggan', 'layanan', 'konter'])->where('id_user', Auth::user()->id)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('service_finished')
                    ->whereRaw('id_service');
            })
            ->take(3)
            ->get();
    }
    public static function getServiceUser()
    {
        return self::with(['pelanggan', 'layanan', 'konter'])->where('id_user', Auth::user()->id)->get();
    }
}
