<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceStatus extends Model
{
    use HasFactory;
    protected $table = 'service_status';
    protected $guarded = [];

    public function status(): BelongsTo
    {
        return $this->belongsTo(status::class, 'id_status');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'id_service')->withTrashed();
    }

    public static function getNotifStatus($id_service)
    {
        return self::with('status')->where('id_service', $id_service)->latest()->first();
    }
}
