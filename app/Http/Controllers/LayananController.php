<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\LayananKonter;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Layanan Konter',
            'layanan' => Layanan::all(),
        ];
        return view('admin.layanan.index', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'layanan' => ['required', 'string', 'max:255']
        ]);

        $layanan = new Layanan;
        $layanan->layanan = $request->layanan;
        if ($layanan->save()) {

            return redirect()->back()->with('success', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()->with('danger', 'Gagal menambahkan data');
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'layanan' => ['required', 'string', 'max:255']
        ]);

        $layanan = Layanan::find($id);
        $layanan->layanan = $request->layanan;
        if ($layanan->save()) {

            return redirect()->back()->with('success', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()->with('danger', 'Gagal menambahkan data');
        }
    }
    public function destroy($id)
    {
        $layanan = Layanan::find($id);
        $cek_layanan_konter = LayananKonter::where('id_layanan', $id)->count();
        if ($cek_layanan_konter != 0) {
            return redirect()->back()->with('danger', 'Layanan telah digunakan oleh konter');
        } else {
            $layanan->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus data');
        }
    }
}
