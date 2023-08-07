<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function admin()
    {
        $data = [
            'title' => 'Akun Admin',
            'user' => User::where('role', 'admin')->get(),
        ];
        return view('admin.user.admin', $data);
    }
    public function konter()
    {
        $data = [
            'title' => 'Akun Konter',
            'user' => User::where('role', 'konter')->get(),
        ];
        return view('admin.user.konter', $data);
    }
    public function user()
    {
        $data = [
            'title' => 'Akun User',
            'user' => User::where('role', 'user')->get(),
        ];
        return view('admin.user.user', $data);
    }
    public function akunKonter()
    {
        $user = User::find(Auth::user()->id);
        $data = [
            'title' => 'Akun',
            'user' => $user,
        ];

        return view('konter.user.akun', $data);
    }
    public function akunAdmin()
    {
        $user = User::find(Auth::user()->id);
        $data = [
            'title' => 'Akun',
            'user' => $user,
        ];

        return view('admin.user.akun', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'avatar' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp', 'between:0,2048'],
            'name' => ['required', 'string', 'max:191'],
            'password' => ['required', 'string', 'max:191'],
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['required', 'string', 'max:191']
        ]);

        if ($request->hasFile('avatar')) {
            $filename = Str::random(32) . '.' . $request->file('avatar')->getClientOriginalExtension();
            $file_path = $request->file('avatar')->storeAs('public/uploads', $filename);
        }
        $user = new User;
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = $request->role;
        $user->avatar = isset($file_path) ? $file_path : '';
        if ($user->save()) {
            return redirect()->back()->with('success', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()->with('danger', 'Gagal menambahkan data');
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'avatar' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp', 'between:0,2048'],
            'name' => ['nullable', 'string', 'max:191'],
            'password' => ['nullable', 'string', 'max:191'],
            'name' => ['nullable', 'string', 'max:191'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'string', 'max:191']
        ]);

        $user = User::findOrFail($id);

        if ($request->hasFile('avatar')) {
            if ($user->avatar != '') {
                Storage::delete($user->avatar);
            }
            $filename = Str::random(32) . '.' . $request->file('avatar')->getClientOriginalExtension();
            $file_path = $request->file('avatar')->storeAs('public/uploads', $filename);
        }

        if (isset($request->password)) {
            $user->name = $request->name;
        }
        if (isset($request->password)) {
            $user->password = Hash::make($request->password);
        }

        if (isset($request->name)) {
            $user->name = $request->name;
        }
        if (isset($request->email)) {
            $user->email = $request->email;
        }
        if (isset($request->phone)) {
            $user->phone = $request->phone;
        }
        $user->avatar = isset($file_path) ? $file_path : $user->avatar;
        $user->save();

        return redirect()->back()->with('success', 'Berhasil mengubah data');
    }
}
