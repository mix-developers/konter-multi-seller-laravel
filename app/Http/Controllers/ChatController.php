<?php

namespace App\Http\Controllers;

use App\Lib\PusherFactory;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Chat Pelanggan',
            'chat' => Chat::selectRaw("count(*) as total_chat, from_user,to_user")
                ->where('to_user', Auth::user()->id)
                ->groupBy('to_user')
                ->groupBy('from_user')
                ->get(),
        ];
        return view('konter.chat.index', $data);
    }
}
