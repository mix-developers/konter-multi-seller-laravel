<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}
