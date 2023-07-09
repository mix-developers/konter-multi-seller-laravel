<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kategori Produk',
            'kategori' => Kategori::all(),
        ];
        return view('admin.kategori.index', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => ['required', 'string', 'max:255']
        ]);

        $kategori = new Kategori;
        $kategori->kategori = $request->kategori;
        if ($kategori->save()) {

            return redirect()->back()->with('success', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()->with('danger', 'Gagal menambahkan data');
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori' => ['required', 'string', 'max:255']
        ]);

        $kategori = Kategori::find($id);
        $kategori->kategori = $request->kategori;
        if ($kategori->save()) {

            return redirect()->back()->with('success', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()->with('danger', 'Gagal menambahkan data');
        }
    }
    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
