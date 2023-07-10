<?php

namespace App\Http\Controllers;

use App\Models\Konter;
use App\Models\Layanan;
use App\Models\LayananKonter;
use App\Models\ReviewRating;
use App\Models\Service;
use App\Models\ServiceFinished;
use App\Models\ServiceStatus;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $konter = Konter::where('id_pemilik', Auth::user()->id)->first();
        $data = [
            'title' => 'Daftar Service',
            'service' => Service::getAll(),
            'konter' => $konter,
            'pelanggan' => User::where('role', 'user')->get(),
            'layanan_list' => LayananKonter::getLayananKonter($konter->id),
        ];
        return view('konter.service.index', $data);
    }
    public function detail($id)
    {
        $service = Service::find($id);
        $data = [
            'title' => 'Detail Service',
            'service' => $service,
            'status' => Status::all(),
            'status_service' => ServiceStatus::where('id_service', $service->id)->get(),
        ];
        return view('konter.service.detail', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_konter' => ['required'],
            'id_user' => ['required'],
            'id_layanan' => ['required'],

        ]);
        if ($request->hasFile('thumbnail')) {
            $filename = Str::random(32) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            $file_path = $request->file('thumbnail')->storeAs('public/uploads', $filename);
        }
        $milliseconds = round(microtime(true) * 1000);
        $service = new Service();
        $service->code = 'SVC' . $milliseconds;
        $service->id_layanan = $request->id_layanan;
        $service->id_user = $request->id_user;
        $service->id_konter = $request->id_konter;
        $service->description = $request->description;
        $service->date = date('d-m-Y');
        $service->thumbnail = isset($file_path) ? $file_path : '';

        if ($service->save()) {

            return redirect()->back()->with('success', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()->with('danger', 'Gagal menambahkan data');
        }
    }
    public function storeStatus(Request $request)
    {
        $request->validate([
            'id_service' => ['required'],
            'id_status' => ['required'],

        ]);
        if ($request->hasFile('thumbnail')) {
            $filename = Str::random(32) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            $file_path = $request->file('thumbnail')->storeAs('public/uploads', $filename);
        }
        $status = new ServiceStatus();
        $status->id_service = $request->id_service;
        $status->id_status = $request->id_status;
        $status->description = $request->description;
        $status->date = date('d-m-Y');
        $status->thumbnail = isset($file_path) ? $file_path : '';

        if ($status->save()) {
            return redirect()->back()->with('success', 'Berhasil menambahkan status');
        } else {
            return redirect()->back()->with('danger', 'Gagal menambahkan status');
        }
    }
    public function storeFinish(Request $request)
    {
        $request->validate([
            'id_service' => ['required'],
        ]);

        $finish = new ServiceFinished();
        $finish->id_service = $request->id_service;
        $finish->date = date('d-m-Y');

        if ($finish->save()) {
            return redirect()->back()->with('success', 'Berhasil klaim');
        } else {
            return redirect()->back()->with('danger', 'Gagal klaim');
        }
    }
    public function storeRating(Request $request)
    {
        $request->validate([
            'id_service' => ['required'],
            'id_konter' => ['required'],
            'id_user' => ['required'],
        ]);

        $rating = new ReviewRating();
        $rating->id_service = $request->id_service;
        $rating->id_konter = $request->id_konter;
        $rating->id_user = $request->id_user;
        $rating->comments = $request->comments;
        $rating->star_rating = $request->star_rating;
        $rating->date = date('d-m-Y');

        if ($rating->save()) {
            return redirect()->back()->with('success', 'Berhasil memberikan rating dan ulasan');
        } else {
            return redirect()->back()->with('danger', 'Gagal memberikan rating dan ulasan');
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_konter' => ['required'],
            'id_user' => ['required'],
            'id_layanan' => ['required'],
        ]);
        $service = Service::findOrFail($id);

        if ($request->hasFile('thumbnail')) {
            if ($service->thumbnail != '') {
                Storage::delete($service->thumbnail);
            }
            $filename = Str::random(32) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            $file_path = $request->file('thumbnail')->storeAs('public/uploads', $filename);
        }
        $milliseconds = round(microtime(true) * 1000);

        $service->code = 'SVC' . $milliseconds;
        $service->id_layanan = $request->id_layanan;
        $service->id_user = $request->id_user;
        $service->id_konter = $request->id_konter;
        $service->description = $request->description;
        $service->date = date('d-m-Y');
        $service->thumbnail = isset($file_path) ? $file_path : $service->thumbnail;
        if ($service->save()) {
            return redirect()->back()->with('success', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()->with('danger', 'Gagal menambahkan data');
        }
    }
    public function destroy($id)
    {
        $service = Service::find($id);
        if ($service->thumbnail != '') {
            Storage::delete($service->thumbnail);
        }
        $service->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
    public function destroyStatus($id)
    {
        $status = ServiceStatus::find($id);
        if ($status->thumbnail != '') {
            Storage::delete($status->thumbnail);
        }
        $status->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus status');
    }
}
