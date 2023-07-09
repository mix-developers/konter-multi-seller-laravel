<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LayananKonter extends Model
{
    use HasFactory;
    protected $table = 'layanan_konter';
    protected $guarded = [];
    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class, 'id_layanan');
    }
    public static function getLayananKonter($id_konter)
    {
        return self::with(['layanan'])->where('id_konter', $id_konter)->get();
    }
}
