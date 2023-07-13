<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ReviewRating;
use App\Models\Service;
use App\Models\ServiceFinished;
use App\Models\ServiceStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $data = [
            'title' => 'Akun : ' . $user->name,
            'user' => $user,
        ];
        return view('user.index', $data);
    }
    public function ulasan()
    {
        $data = [
            'title' => 'Ulasan Anda',
            'rating' => ReviewRating::where('id_user', Auth::user()->id)->get(),
        ];
        return view('user.ulasan', $data);
    }
    public function status_service()
    {
        $data = [
            'title' => 'Status Service',
            'service' => Service::getServiceUser(),
        ];
        return view('user.status_service', $data);
    }
    public function ubah_password()
    {
        $data = [
            'title' => 'Ubah Password Anda',
        ];
        return view('user.ubah_password', $data);
    }

    public function status($code)
    {

        $service = Service::where('code', $code)->first();
        $data = [
            'title' => 'Kode service : ' . $service->code,
            'service' => $service,
            'keyword' => $service->code,
            'status' => ServiceStatus::where('id_service', $service->id)->get(),
        ];
        return view('user.status', $data);
    }
    public function sendChat(Request $request)
    {
        $request->validate([
            'from_user' => ['required'],
            'id_konter' => ['required'],
            'to_user' => ['required'],
            'content' => ['required'],
        ]);

        $chat = new Chat();
        $chat->from_user = $request->from_user;
        $chat->id_konter = $request->id_konter;
        $chat->to_user = $request->to_user;
        $chat->content = $request->content;

        if ($chat->save()) {
            return redirect()->back()->with('success', 'Berhasil memberikan rating dan ulasan');
        } else {
            return redirect()->back()->with('danger', 'Gagal memberikan rating dan ulasan');
        }
    }
}
