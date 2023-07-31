<?php

namespace App\Http\Controllers;

use App\Models\Konter;
use App\Models\Produk;
use App\Models\ProdukStok;
use App\Models\ReviewRating;
use App\Models\Service;
use App\Models\ServicePrice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KonterController extends Controller
{
    public function index()
    {
        $konter = Konter::where('id_pemilik', Auth::id())->first();
        if ($konter != null) {
            $month_now = Carbon::now()->startOfMonth();
            $data = [
                'title' => 'Dashboard Konter',
                'konter' => $konter,
                'income' => ServicePrice::getIncomeMonthlyKonter(),
                'total_service' => Service::getKonter($konter->id)->count(),
                'total_service_monthly' => Service::getKonter($konter->id)->where('created_at', '>=', $month_now)->count(),
                'total_product' => Produk::getProdukKonter($konter->id)->count(),
                'total_product_stok' => ProdukStok::getStokCountAvailable($konter->id),
            ];
        } else {
            $data = [
                'title' => 'Dashboard Konter',
                'konter' => $konter,
            ];
        }


        return view('konter.dashboard', $data);
    }

    public function ulasan()
    {
        $konter = Konter::where('id_pemilik', Auth::id())->first();

        $data = [
            'title' => 'Ulasan pengunjung',
            'ulasan' => ReviewRating::where('id_konter', $konter->id)->get(),
        ];

        return view('konter.ulasan.index', $data);
    }
}
