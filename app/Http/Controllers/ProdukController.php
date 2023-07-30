<?php

namespace App\Http\Controllers;

use App\Models\Konter;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Daftar Produk',
            'produk' => Produk::all(),
        ];
        return view('admin.produk.index', $data);
    }
    public function list()
    {
        $konter = Konter::where('id_pemilik', Auth::user()->id)->first();
        $data = [
            'title' => 'Daftar Produk',
            'produk' => Produk::where('id_konter', $konter->id)->get(),
            'konter' => $konter
        ];
        return view('konter.produk.index', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'id_konter' => ['required'],
            'price' => ['required'],

        ]);
        if ($request->hasFile('thumbnail')) {
            $filename = Str::random(32) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            $file_path = $request->file('thumbnail')->storeAs('public/uploads', $filename);
        }
        $produk = new Produk();
        $produk->name = $request->name;
        $produk->slug = Str::slug($request->name);
        $produk->id_konter = $request->id_konter;
        $produk->price = $request->price;
        $produk->description = $request->description;
        $produk->thumbnail = isset($file_path) ? $file_path : '';
        if ($produk->save()) {

            return redirect()->back()->with('success', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()->with('danger', 'Gagal menambahkan data');
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'id_konter' => ['required'],
            'price' => ['required'],
        ]);
        $produk = Produk::findOrFail($id);

        if ($request->hasFile('thumbnail')) {
            if ($produk->thumbnail != '') {
                Storage::delete($produk->thumbnail);
            }
            $filename = Str::random(32) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            $file_path = $request->file('thumbnail')->storeAs('public/uploads', $filename);
        }

        $produk->name = $request->name;
        $produk->slug = Str::slug($request->name);
        $produk->id_konter = $request->id_konter;
        $produk->price = $request->price;
        $produk->status = $request->status;
        $produk->stok = $request->stok;
        $produk->description = $request->description;
        $produk->thumbnail = isset($file_path) ? $file_path : $produk->thumbnail;
        if ($produk->save()) {
            return redirect()->back()->with('success', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()->with('danger', 'Gagal menambahkan data');
        }
    }
    public function destroy($id)
    {
        $produk = Produk::find($id);
        if ($produk->thumbnail != '') {
            Storage::delete($produk->thumbnail);
        }
        $produk->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
