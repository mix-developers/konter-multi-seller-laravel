<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function admin()
    {
        $data = [
            'title' => 'Laporan Admin',
            'produk' => Produk::all(),
        ];
        return view('admin.laporan.index', $data);
    }
    public function konter()
    {
        $data = [
            'title' => 'Laporan Konter',
            'produk' => Produk::all(),
        ];
        return view('konter.laporan.index', $data);
    }
}
