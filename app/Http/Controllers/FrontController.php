<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Konter;
use App\Models\Layanan;
use App\Models\LayananKonter;
use App\Models\Produk;
use App\Models\Service;
use App\Models\ServiceStatus;
use Illuminate\Http\Request;

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
        $data = [
            'title' => 'Informasi Konter : ' . $konter->name,
            'konter' => $konter,
            'layanan' => $layanan,
            'produk' => Produk::where('id_konter', $konter->id)->paginate(10),
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
            'keyword' => ['required', 'string', 'max:16', 'min:16']
        ]);
        $service = Service::where('code', 'like', '%' . $request->keyword . '%')->first();
        $data = [
            'title' => 'Kode service : ' . $request->keyword,
            'service' => $service,
            'keyword' => $request->keyword,
            'status' => ServiceStatus::where('id_service', $service->id)->get(),
        ];
        return view('pages.service', $data);
    }
}
