<?php

namespace App\Http\Controllers;

use App\Models\Konter;
use App\Models\ReviewRating;
use App\Models\ServicePrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KonterController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Konter',
            'income' => ServicePrice::getIncomeMonthlyKonter(),
        ];
        return view('konter.dashboard', $data);
    }
    public function ulasan()
    {
        $konter = Konter::where('id_pemilik', Auth::user()->id)->first();
        $data = [
            'title' => 'Ulasan pengunjung',
            'ulasan' => ReviewRating::where('id_konter', $konter->id)->get(),
        ];
        return view('konter.ulasan.index', $data);
    }
}
