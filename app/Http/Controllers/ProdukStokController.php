<?php

namespace App\Http\Controllers;

use App\Models\Konter;
use App\Models\Produk;
use App\Models\ProdukStok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukStokController extends Controller
{
    public function index()
    {
        $konter = Konter::where('id_pemilik', Auth::user()->id)->first();
        $data = [
            'title' => 'Stok Produk',
            'konter' => $konter,
            'stok' => ProdukStok::getStokProduk($konter->id),
        ];
        return view('konter.stok.index', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_konter' => ['required'],
            'id_produk' => ['required'],
            'stok' => ['required'],
            'type' => ['required'],

        ]);
        $stok = new ProdukStok();
        $stok->id_konter = $request->id_konter;
        $stok->id_produk = $request->id_produk;
        $stok->stok = $request->stok;
        $stok->type = $request->type;

        $cek_stok = ProdukStok::getTotalStokProduk($request->id_produk);
        // dd($cek_stok);

        if ($request->type == 0 && $request->stok >= $cek_stok) {

            return redirect()->back()->with('danger', 'Stok kurang');
        } else {
            if ($stok->save()) {

                return redirect()->back()->with('success', 'Berhasil menambahkan data');
            } else {
                return redirect()->back()->with('danger', 'Gagal menambahkan data');
            }
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([

            'id_konter' => ['required'],
            'id_produk' => ['required'],
            'stok' => ['required'],
            'type' => ['required'],
        ]);
        $stok = ProdukStok::findOrFail($id);

        $stok->id_konter = $request->id_konter;
        $stok->id_produk = $request->id_produk;
        $stok->stok = $request->stok;
        $stok->type = $request->type;

        if ($stok->save()) {
            return redirect()->back()->with('success', 'Berhasil mengubah data');
        } else {
            return redirect()->back()->with('danger', 'Gagal mengubah data');
        }
    }
    public function destroy($id)
    {
        $stok = ProdukStok::find($id);
        $stok->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
