<?php

namespace App\Models;

use GuzzleHttp\RetryMiddleware;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produk extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function konter(): BelongsTo
    {
        return $this->belongsTo(Konter::class, 'id_konter');
    }
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(kategori::class, 'id_kategori');
    }
    public static function getCountKategori($id_kategori)
    {
        return self::with(['konter', 'kategori'])->where('id_kategori', $id_kategori)->count();
    }
}
