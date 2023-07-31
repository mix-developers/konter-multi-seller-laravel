<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReviewRating extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'review_ratings';

    public function konter(): BelongsTo
    {
        return $this->belongsTo(Konter::class, 'id_konter');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'id_service');
    }

    public static function getKonterCount($id_konter)
    {
        return self::where('id_konter', $id_konter)->count();
    }

    public static function getRatingCount($id_konter)
    {
        return self::where('id_konter', $id_konter)->sum('star_rating');
    }

    public static function getKonterRating($id_konter)
    {
        $total_review = self::getKonterCount($id_konter);
        $total_rating = self::getRatingCount($id_konter);

        // To avoid division by zero, handle the case where there are no reviews.
        if ($total_review === 0) {
            return 0;
        }

        return ceil($total_rating / $total_review);
    }
}
