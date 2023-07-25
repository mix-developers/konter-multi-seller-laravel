<?php

namespace App\Http\Controllers;

use App\Models\Konter;
use App\Models\Produk;
use App\Models\Service;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

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
        $konter = Konter::where('id_pemilik', Auth::user()->id)->first();
        $service = Service::where('id_konter', $konter->id)->withTrashed()->get();
        $data = [
            'title' => 'Laporan Konter',
            'produk' => Produk::where('id_konter', $konter->id)->get(),
            'service' => $service,
        ];
        return view('konter.laporan.index', $data);
    }
    public function exportService(Request $request)
    {
        // dd($request);
        $from_date = date("d-m-Y", strtotime($request->from_date));
        $to_date = date("d-m-Y", strtotime($request->to_date));
        $data = Service::whereBetween('date', [$from_date, $to_date])->get();

        $pdf = FacadePdf::loadView('konter.laporan.pdf.export_service', [
            'data' => $data,
            'from_date' => $from_date,
            'to_date' => $to_date,
        ])->setPaper('a4', 'landscape')->setOption(['dpi' => 150, 'defaultFont' => 'arial']);

        return $pdf->stream($from_date . ' sampai ' . $to_date . '.pdf');
    }
    public function exportProduk()
    {
        $konter = Konter::where('id_pemilik', Auth::user()->id)->first();
        $data = Produk::where('id_konter', $konter->id)->get();

        $pdf = FacadePdf::loadView('konter.laporan.pdf.export_produk', [
            'data' => $data,
            'konter' => $konter,
        ])->setPaper('a4', 'landscape')->setOption(['dpi' => 150, 'defaultFont' => 'arial']);

        return $pdf->stream('Data Produk ' . $konter->name . date('d-m-Y') . '.pdf');
    }
}
