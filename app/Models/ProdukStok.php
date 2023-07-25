<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdukStok extends Model
{
    use HasFactory;
    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
    public function konter(): BelongsTo
    {
        return $this->belongsTo(Konter::class, 'id_konter');
    }
    public static function getStokProduk($id)
    {
        return self::with(['produk', 'konter'])->where('id_produk', $id)->get();
    }
    public static function getTotalStokProduk($id)
    {
        $masuk = self::with(['produk', 'konter'])->where('id_produk', $id)->where('type', 1)->sum('stok');
        $keluar = self::with(['produk', 'konter'])->where('id_produk', $id)->where('type', 0)->sum('stok');

        return $masuk - $keluar;
    }
}
