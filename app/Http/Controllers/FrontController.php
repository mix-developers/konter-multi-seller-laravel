<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Kategori;
use App\Models\Konter;
use App\Models\Layanan;
use App\Models\LayananKonter;
use App\Models\Produk;
use App\Models\ReviewRating;
use App\Models\Service;
use App\Models\ServiceStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Beranda',
            'produk' => Produk::take(3)->get(),
            'konter' => Konter::getHome(),
        ];
        return view('pages.index', $data);
    }
    public function konter_list()
    {
        $data = [
            'title' => 'Daftar Konter',
            'konter' => Konter::getListFront(),
        ];
        return view('pages.toko', $data);
    }
    public function konter_detail($slug)
    {
        $konter = Konter::where('slug', $slug)->first();
        $layanan = LayananKonter::getLayananKonter($konter->id);
        $rating = ReviewRating::where('id_konter', $konter->id)->get();
        // if (Auth::check()) {
        //     $chat = Chat::where('from_user', Auth::user()->id)->orWhere('to_user', Auth::user()->id)->where('id_konter', $konter->id)->get();
        // } else {
        //     $chat = '';
        // }
        $data = [
            'title' => 'Informasi Konter : ' . $konter->name,
            'konter' => $konter,
            'layanan' => $layanan,
            'rating' => $rating,
            // 'chat' => $chat,
            'produk' => Produk::where('id_konter', $konter->id)->paginate(2),
        ];
        return view('pages.toko_detail', $data);
    }
    public function produk_list()
    {
        $data = [
            'title' => 'Daftar Produk',
            'produk' => Produk::paginate(10),
            'kategori' => Kategori::all(),
        ];
        return view('pages.produk', $data);
    }
    public function service(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'max:16', 'min:16']
        ]);
        $service = Service::where('code', 'like', '%' . $request->code . '%')->first();
        $data = [
            'title' => 'Kode service : ' . $request->code,
            'service' => $service,
            'keyword' => $request->keyword,
            'status' => ServiceStatus::where('id_service', $service->id)->get(),
        ];
        return view('pages.service', $data);
    }
}
