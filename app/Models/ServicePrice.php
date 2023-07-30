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
    //dashboard admin
    public static function getIncomeMonthly()
    {
        $month_before = Carbon::now()->startOfMonth()->subMonth(1);
        $month_now = Carbon::now()->startOfMonth();
        $income_before_month = self::with('services')->whereMonth('created_at', $month_before)->sum('price');
        $income_after_month = self::with('services')->whereMonth('created_at', $month_now)->sum('price');

        return $income_after_month - $income_before_month;
    }
    public static function getIncomeMonthlyBefore()
    {
        $month_before = Carbon::now()->startOfMonth()->subMonth(1);
        $data = self::with('services')->whereMonth('created_at', $month_before)->sum('price');

        return $data;
    }
    public static function getIncomeMonthlyNow()
    {
        $data =  self::with('services')->whereMonth('created_at', Carbon::now()->startOfMonth())->sum('price');

        return $data;
    }
    public static function getIncomeMonthlyPercent()
    {
        $month_before = self::getIncomeMonthlyBefore();
        $income = self::with('services')->whereMonth('created_at', Carbon::now()->startOfMonth())->sum('price');
        $data = (($income - $month_before) / $income) * 100;

        return $data;
    }
    //dashboard konter
    public static function getIncomeMonthlyKonter()
    {
        $konter = Konter::where('id_pemilik', Auth::user()->id)->first();
        $id_konter = $konter->id;
        $month_before = Carbon::now()->startOfMonth()->subMonth(1);
        $month_now = Carbon::now()->startOfMonth();
        $income_before_month = self::with('services')->whereHas('services', function ($query) use ($id_konter) {
            $query->where('id_konter', $id_konter);
        })->whereMonth('created_at', $month_before)->sum('price');
        $income_after_month = self::with('services')->whereHas('services', function ($query) use ($id_konter) {
            $query->where('id_konter', $id_konter);
        })->whereMonth('created_at', $month_now)->sum('price');

        return $income_after_month - $income_before_month;
    }
    public static function getIncomeMonthlyBeforeKonter()
    {
        $konter = Konter::where('id_pemilik', Auth::user()->id)->first();
        $id_konter = $konter->id;
        $month_before = Carbon::now()->startOfMonth()->subMonth(1);
        $data = self::with('services')->whereHas('services', function ($query) use ($id_konter) {
            $query->where('id_konter', $id_konter);
        })->whereMonth('created_at', $month_before)->sum('price');

        return $data;
    }
    public static function getIncomeMonthlyNowKonter()
    {
        $konter = Konter::where('id_pemilik', Auth::user()->id)->first();
        $id_konter = $konter->id;
        $data =  self::with('services')->whereHas('services', function ($query) use ($id_konter) {
            $query->where('id_konter', $id_konter);
        })->whereMonth('created_at', Carbon::now()->startOfMonth())->sum('price');

        return $data;
    }
    public static function getIncomeMonthlyPercentKonter()
    {
        $konter = Konter::where('id_pemilik', Auth::user()->id)->first();
        $id_konter = $konter->id;
        $month_before = self::getIncomeMonthlyBefore();
        $income = self::with('services')->whereHas('services', function ($query) use ($id_konter) {
            $query->where('id_konter', $id_konter);
        })->whereMonth('created_at', Carbon::now()->startOfMonth())->sum('price');
        $data = (($income - $month_before) / $income) * 100;

        return $data;
    }
}
