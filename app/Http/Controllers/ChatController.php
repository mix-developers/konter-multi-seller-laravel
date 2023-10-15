<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\ChatEvent; // Pastikan Anda memiliki model Event yang sesuai

use App\Models\Chat;
use App\Models\ChatRoomUser;
use App\Models\Konter;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    public function room($room)
    {
        // Get room
        if ($room == null) {
            $room = ChatRoomUser::where('user_id', Auth::user()->id)->first()->chat_room_id;
        }
        $room = DB::table('chat_rooms')->where('id', $room)->first();
        $chat_rooms = DB::table('chat_room_users')->where('chat_room_id', $room->id)->where('user_id', '!=', Auth::user()->id)->first();
        $konter = Konter::where('id_pemilik', $chat_rooms->user_id)->first();
        $title = 'Chat Ke Konter : ' . $konter->name;
        // Get users
        $users = DB::table('chat_room_users')->where('chat_room_id', $room->id)->get();
        $data = [
            'room', 'users', 'title', 'konter'
        ];
        return view('pages.chat', compact($data));
    }
    public function roomKonter($room)
    {
        // Get room
        $room = DB::table('chat_rooms')->where('id', $room)->first();
        $chat_rooms = DB::table('chat_room_users')->where('chat_room_id', $room->id)->where('user_id', '!=', Auth::user()->id)->first();
        $user = User::find($chat_rooms->user_id);
        $title = 'Chat Ke Pelanggan : ' . $user->name;
        // Get users
        $users = DB::table('chat_room_users')->where('chat_room_id', $room->id)->get();
        $data = [
            'room', 'users', 'title', 'konter'
        ];
        return view('konter.chat', compact($data));
    }
    public function konter()
    {
        $room_user = ChatRoomUser::where('user_id', Auth::user()->id)->get();
        // dd($room_user);
        $data = [
            'title' => 'Chat Pelanggan',
            'room_user' => $room_user,
            // 'user' => ChatRoomUser::where('chat_room_id', $room_user->chat_room_id)->where('user_id', '!=', Auth::user()->id)->get()
        ];
        return view('konter.chat.index', $data);
    }

    public function getChat($room)
    {
        // Join with user
        $chats = DB::table('chats')
            ->join('users', 'users.id', '=', 'chats.user_id')
            ->where('chat_room_id', $room)
            ->select('chats.*', 'users.name as user_name')
            ->latest()
            ->get();

        return response()->json($chats);
    }

    // Send chat
    public function sendChat(Request $request)
    {
        $chat = DB::table('chats')->insert([
            'chat_room_id' => $request->room,
            'user_id' => auth()->user()->id,
            'message' => $request->message,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Trigger event
        broadcast(new ChatEvent($request->room, $request->message, auth()->user()->id));

        return response()->json($chat);
    }

    public function chat($user)
    {
        $my_id = auth()->user()->id;
        $target_id = $user;

        $my_room = DB::table('chat_room_users');
        $target_room = clone $my_room;

        // Get my room
        $my_room = $my_room->where('user_id', $my_id)->get()->keyBy('chat_room_id')->toArray();
        // Get target room
        $target_room = $target_room->where('user_id', $target_id)->get()->keyBy('chat_room_id')->toArray();

        // Check room
        $room = array_intersect_key($my_room, $target_room);

        // If room exists
        if ($room) return redirect()->route('chat.room', ['room' => array_keys($room)[0]]);

        // If room doesn't exist
        $uuid = Str::orderedUuid();
        $room = DB::table('chat_rooms')->insert([
            'id' => $uuid,
            'name' => 'generate by system',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Add users to room
        DB::table('chat_room_users')->insert([
            [
                'chat_room_id' => $uuid,
                'user_id' => $my_id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'chat_room_id' => $uuid,
                'user_id' => $target_id,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        return redirect()->route('chat.room', ['room' => $uuid]);
    }
    public function readAll($id)
    {

        $room = Chat::where('user_id', $id)->get();
        foreach ($room as $r) {
            $chat = Chat::where('chat_room_id', $r->chat_room_id)->get();
            foreach ($chat as $item) {
                $item->is_read = 1;
                $item->save();
            }
        }
        return redirect()->back();

        // $room = Chat::where('user_id', $id)->get();
        // foreach ($room as $r) {
        //     $chat = Chat::where('chat_room_id', $r->chat_room_id)
        //         ->where('is_read', 0)
        //         ->where('user_id', Auth::user()->id)
        //         ->get();
        //     foreach ($chat as $item) {
        //         $chat = Chat::find($item->id);
        //         $chat->is_read = 1;
        //         $chat->save();
        //     }
        // }
        return redirect()->back();
    }
    public function readUser($chat_room_id, $id)
    {
        $chat = Chat::find($id);
        $chat->is_read = 1;
        $chat->save();

        return redirect()->to('/chat/room/' . $chat_room_id);
    }
}
