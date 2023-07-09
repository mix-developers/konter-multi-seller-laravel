<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KonterController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Konter'
        ];
        return view('konter.dashboard', $data);
    }
}
