<?php

namespace App\Http\Controllers;

use App\Models\Konter;
use App\Models\Layanan;
use App\Models\LayananKonter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LayananKonterController extends Controller
{
    public function index()
    {
        $konter = Konter::where('id_pemilik', Auth::user()->id)->first();
        $data = [
            'title' => 'Layanan Konter',
            'layanan' => LayananKonter::where('id_konter', $konter->id)->get(),
            'layanan_list' => Layanan::all(),
        ];
        return view('konter.layanan.index', $data);
    }
    public function store(Request $request)
    {
        $konter = Konter::where('id_pemilik', Auth::user()->id)->first();



        $request->validate([
            'id_layanan' => ['required'],
        ]);

        $cek = LayananKonter::where('id_konter', $konter->id)->where('id_layanan', $request->id_layanan)->count();

        $layanan = new LayananKonter;
        $layanan->id_layanan = $request->id_layanan;
        $layanan->id_konter = $konter->id;
        $layanan->id_user = Auth::user()->id;
        // dd($cek);
        if ($cek <= 0) {
            $layanan->save();
            return redirect()->back()->with('success', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()->with('danger', 'Gagal menambahkan data');
        }
    }
    public function update(Request $request, $id)
    {
        $konter = Konter::where('id_pemilik', Auth::user()->id)->first();
        $request->validate([
            'id_layanan' => ['required', 'string', 'max:255']
        ]);
        $layanan = LayananKonter::find($id);
        $layanan->id_layanan = $request->id_layanan;
        $layanan->id_konter = $konter->id;
        $layanan->id_user = Auth::user()->id;
        if ($layanan->save()) {

            return redirect()->back()->with('success', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()->with('danger', 'Gagal menambahkan data');
        }
    }
    public function destroy($id)
    {
        $layanan = LayananKonter::find($id);
        $layanan->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
