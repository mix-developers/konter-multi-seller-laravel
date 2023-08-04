<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class ServicePrice extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'service_prices';

    public function services(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'id_service');
    }

    public static function getPriceService($id)
    {
        return self::where('id_service', $id)->get();
    }

    public static function getTotalService($id)
    {
        return self::where('id_service', $id)->sum('price');
    }

    // Dashboard admin
    public static function getIncomeMonthly()
    {
        $monthBefore = Carbon::now()->startOfMonth()->subMonth(1);
        $monthNow = Carbon::now()->startOfMonth();

        return self::whereBetween('created_at', [$monthBefore, $monthNow])->sum('price');
    }
    public static function getIncomeMonthlyBefore()
    {
        return self::whereMonth('created_at', Carbon::now()->startOfMonth()->subMonth(1))->sum('price');
    }
    public static function getIncomeMonthlyNow()
    {
        return self::whereMonth('created_at', Carbon::now()->startOfMonth())->sum('price');
    }
    public static function getIncomeMonthlyPercent()
    {
        $month_before = self::getIncomeMonthlyBefore();
        $income = self::whereMonth('created_at', Carbon::now()->startOfMonth())->sum('price');

        // To avoid division by zero, handle the case where income is zero.
        if ($income === 0) {
            return 0;
        }

        return (($income - $month_before) / $income) * 100;
    }

    // Dashboard konter

    public static function getIncomeMonthlyKonter()
    {
        $konter = Konter::where('id_pemilik', Auth::id())->first();
        $id_konter = $konter->id;
        $month_before = Carbon::now()->startOfMonth()->subMonth(1);
        $month_now = Carbon::now()->startOfMonth();
        $income_before_month = self::whereHas('services', function ($query) use ($id_konter) {
            $query->where('id_konter', $id_konter);
        })->whereMonth('created_at', $month_before)->sum('price');
        $income_after_month = self::whereHas('services', function ($query) use ($id_konter) {
            $query->where('id_konter', $id_konter);
        })->whereMonth('created_at', $month_now)->sum('price');

        return $income_after_month - $income_before_month;
    }

    public static function getIncomeMonthlyBeforeKonter()
    {
        $konter = Konter::where('id_pemilik', Auth::id())->first();
        $id_konter = $konter->id;
        $month_before = Carbon::now()->startOfMonth()->subMonth(1);
        return self::whereHas('services', function ($query) use ($id_konter) {
            $query->where('id_konter', $id_konter);
        })->whereMonth('created_at', $month_before)->sum('price');
    }

    public static function getIncomeMonthlyNowKonter()
    {
        $konter = Konter::where('id_pemilik', Auth::id())->first();
        $id_konter = $konter->id;
        return self::whereHas('services', function ($query) use ($id_konter) {
            $query->where('id_konter', $id_konter);
        })->whereMonth('created_at', Carbon::now()->startOfMonth())->sum('price');
    }

    public static function getIncomeMonthlyPercentKonter()
    {
        $konter = Konter::where('id_pemilik', Auth::id())->first();
        $id_konter = $konter->id;
        $month_before = self::getIncomeMonthlyBefore();
        $income = self::whereHas('services', function ($query) use ($id_konter) {
            $query->where('id_konter', $id_konter);
        })->whereMonth('created_at', Carbon::now()->startOfMonth())->sum('price');

        // To avoid division by zero, handle the case where income is zero.
        if ($income === 0) {
            return 0;
        }

        return (($income - $month_before) / $income) * 100;
    }
}
