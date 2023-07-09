<?php

namespace App\Http\Controllers;

use App\Models\Konter;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        $konter = Konter::where('id_pemilik', Auth::user()->id)->first();
        $data = [
            'title' => 'Daftar Service',
            'service' => Service::getAll(),
            'konter' => $konter,
        ];
        return view('konter.service.index', $data);
    }
}
