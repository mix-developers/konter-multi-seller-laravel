<?php

namespace App\Http\Controllers;

use App\Models\Konter;
use App\Models\Layanan;
use App\Models\LayananKonter;
use App\Models\Notifikasi;
use App\Models\ReviewRating;
use App\Models\Service;
use App\Models\ServiceCancelled;
use App\Models\ServiceFinished;
use App\Models\ServiceLayanan;
use App\Models\ServicePrice;
use App\Models\ServiceStatus;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Twilio\Rest\Client;

class ServiceController extends Controller
{
    public function index()
    {
        $konter = Konter::where('id_pemilik', Auth::user()->id)->first();
        $data = [
            'title' => 'Daftar Service',
            'service' => Service::where('id_konter', $konter->id)->get(),
            'konter' => $konter,
            'pelanggan' => User::where('role', 'user')->get(),
            'layanan_list' => LayananKonter::getLayananKonter($konter->id),
        ];
        return view('konter.service.index', $data);
    }
    public function detail($id)
    {
        try {
            $konter = Konter::where('id_pemilik', Auth::user()->id)->first();
            $service = Service::where('id', $id)->withTrashed()->first();
            $service_price = ServicePrice::where('id_service', $id)->get();
            $user = User::find($service->id_user);
            $data = [
                'title' => 'Detail Service',
                'service' => $service,
                'status' => Status::all(),
                'user' => $user,
                'konter' => $konter,
                'service_price' => $service_price,
                'total_price' => ServicePrice::getTotalService($id),
                'status_service' => ServiceStatus::where('id_service', $service->id)->get(),
            ];
            return view('konter.service.detail', $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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
        $service->save();

        $status = new ServiceStatus();
        $status->service()->associate($service);
        $status->id_status = 1;
        $status->description = $request->description;
        $status->date = date('d-m-Y');
        $status->thumbnail = isset($file_path) ? $file_path : '';

        if ($status->save()) {

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
            'number' => ['required'],

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
    public function storePrice(Request $request)
    {
        $request->validate([
            'id_service' => ['required'],
            'name' => ['required'],
            'price' => ['required'],

        ]);

        $price = new ServicePrice();
        $price->id_service = $request->id_service;
        $price->name = $request->name;
        $price->price = $request->price;
        $price->description = '-';
        $price->quantity = 1;

        if ($price->save()) {
            return redirect()->back()->with('success', 'Berhasil menambahkan harga');
        } else {
            return redirect()->back()->with('danger', 'Gagal menambahkan harga');
        }
    }

    // private function whatsappNotification(string $recipient)
    // {
    //     $sid    = getenv("TWILIO_AUTH_SID");
    //     $token  = getenv("TWILIO_AUTH_TOKEN");
    //     $wa_from = getenv("TWILIO_WHATSAPP_FROM");
    //     $twilio = new Client($sid, $token);

    //     $body = "Hello, welcome to codelapan.com.";

    //     return $twilio->messages->create("whatsapp:$recipient", ["from" => "whatsapp:$wa_from", "body" => $body]);
    // }
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
            'thumbnail' => ['nullable', 'mimes:jpeg,png,jpg,gif'],
            'id_user' => ['required'],
        ]);
        if ($request->hasFile('thumbnail')) {
            $filename = Str::random(32) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            $file_path = $request->file('thumbnail')->storeAs('public/uploads', $filename);
        }

        $rating = new ReviewRating();
        $rating->id_service = $request->id_service;
        $rating->id_konter = $request->id_konter;
        $rating->id_user = $request->id_user;
        $rating->comments = $request->comments;
        $rating->thumbnail = isset($file_path) ? $file_path : '';
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
        try {
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
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Terjadi kesalahan : ' . $e->getMessage());
        }
    }
    public function batalkan_service(Request $request,)
    {
        try {
            $service = Service::find($request->id_service);

            //tambah ke tabel service_cancelleds
            $cancel = new ServiceCancelled();
            $cancel->id_service = $request->id_service;
            $cancel->id_user = Auth::user()->id;
            $cancel->keterangan = $request->keterangan;

            //buat notifikasi
            $notifikasi = new Notifikasi();
            $notifikasi->id_user = $service->id_user;
            $notifikasi->content = 'Hai ' . $service->pelanggan->name . 'Service anda dengan kode : ' . $service->code . ' telah dibatalkan oleh konter';
            $notifikasi->type = 'danger';
            $notifikasi->url = '/member/status_service';
            $notifikasi->save();

            if ($cancel->save() &&  $service->delete()) {
                return redirect()->back()->with('success', 'Berhasil membatalkan service');
            } else {
                return redirect()->back()->with('danger', 'Gagal membatalkan service');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Terjadi kesalahan : ' . $e->getMessage());
        }
    }
    public function destroy(Request $request, $id)
    {
        try {
            $service = Service::find($id);
            // if ($service->thumbnail != '') {
            //     Storage::delete($service->thumbnail);
            // }
            //tambah ke tabel service_cancelleds
            $cancel = new ServiceCancelled();
            $cancel->id_service = $request->id_service;
            $cancel->id_user = Auth::user()->id;
            $cancel->keterangan = $request->keterangan;



            if ($cancel->save() &&  $service->delete()) {
                return redirect()->back()->with('success', 'Berhasil membatalkan service');
            } else {
                return redirect()->back()->with('danger', 'Gagal membatalkan service');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Terjadi kesalahan : ' . $e->getMessage());
        }
    }
    public function destroyStatus($id)
    {
        try {
            $status = ServiceStatus::find($id);
            if ($status->thumbnail != '') {
                Storage::delete($status->thumbnail);
            }
            $status->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus status');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Terjadi kesalahan : ' . $e->getMessage());
        }
    }
    public function destroyPrice($id)
    {
        try {
            $price = ServicePrice::find($id);
            $price->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus harga');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Terjadi kesalahan : ' . $e->getMessage());
        }
    }
    public function restore_service($id)
    {
        try {
            $service = Service::where('id', $id)->withTrashed()->first();
            $cancelled = ServiceCancelled::where('id_service', $id)->first();
            if ($cancelled != null) {
                $cancelled->delete();
            }

            //buat notifikasi
            $notifikasi = new Notifikasi();
            $notifikasi->id_user = $service->id_user;
            $notifikasi->content = 'Hai ' . $service->pelanggan->name . 'Service anda dengan kode : ' . $service->code . ' akan dilanjutkan oleh konter';
            $notifikasi->type = 'success';
            $notifikasi->url = '/member/status_service';
            $notifikasi->save();

            $service->deleted_at = null;
            $service->save();

            return redirect()->back()->with('success', 'Berhasil melanjutkan service');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Terjadi kesalahan : ' . $e->getMessage());
        }
    }
}
