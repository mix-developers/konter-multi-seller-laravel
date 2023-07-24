<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServicePrice extends Model
{
    use HasFactory;
    public function services(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'id_service');
    }

    public static function getPriceService($id)
    {
        return self::with('services')->where('id_service', $id)->get();
    }
    public static function getTotalService($id)
    {
        return self::with('services')->where('id_service', $id)->sum('price');
    }
}
