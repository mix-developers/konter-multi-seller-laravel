<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function read_notifikasi($id)
    {
        $notifikasi = Notifikasi::find($id);

        $notifikasi->is_read = 1;
        $notifikasi->save();

        return redirect()->to($notifikasi->url);
    }
}
