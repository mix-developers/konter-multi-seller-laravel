<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class StatusController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Service status',
            'status' => Status::all(),
        ];
        return view('admin.status.index', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'status' => ['required', 'string', 'max:255']
        ]);

        $status = new Status();
        $status->status = $request->status;
        if ($status->save()) {
            return redirect()->back()->with('success', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()->with('danger', 'Gagal menambahkan data');
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', 'string', 'max:255']
        ]);

        $status = Status::find($id);
        $status->status = $request->status;
        if ($status->save()) {

            return redirect()->back()->with('success', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()->with('danger', 'Gagal menambahkan data');
        }
    }
    public function destroy($id)
    {
        $status = Status::find($id);
        $status->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
