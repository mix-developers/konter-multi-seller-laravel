<?php

namespace App\Http\Controllers;

use App\Models\Konter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KonterTokoController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Master Konter',
            'konter' => Konter::getAll(),
            'pemilik' => User::where('role', 'konter')->get(),
        ];
        return view('admin.konter.index', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'id_pemilik' => ['required'],
            'time_open' => ['required'],
            'time_close' => ['required'],
            'address' => ['required'],
        ]);
        if ($request->hasFile('thumbnail')) {
            $filename = Str::random(32) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            $file_path = $request->file('thumbnail')->storeAs('public/uploads', $filename);
        }
        $konter = new Konter;
        $konter->name = $request->name;
        $konter->slug = Str::slug($request->name);
        $konter->id_pemilik = $request->id_pemilik;
        $konter->time_open = $request->time_open;
        $konter->time_close = $request->time_close;
        $konter->description = $request->description;
        $konter->address = $request->address;
        $konter->maps = $request->maps;
        $konter->thumbnail = isset($file_path) ? $file_path : '';
        if ($konter->save()) {

            return redirect()->back()->with('success', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()->with('danger', 'Gagal menambahkan data');
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'id_pemilik' => ['required'],
            'time_open' => ['required'],
            'time_close' => ['required'],
            'address' => ['required'],
        ]);
        $konter = Konter::findOrFail($id);

        if ($request->hasFile('thumbnail')) {
            if ($konter->thumbnail != '') {
                Storage::delete($konter->thumbnail);
            }

            $filename = Str::random(32) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            $file_path = $request->file('thumbnail')->storeAs('public/uploads', $filename);
        }

        $konter->name = $request->name;
        $konter->slug = Str::slug($request->name);
        $konter->id_pemilik = $request->id_pemilik;
        $konter->time_open = $request->time_open;
        $konter->time_close = $request->time_close;
        $konter->description = $request->description;
        $konter->address = $request->address;
        $konter->maps = $request->maps;
        $konter->thumbnail = isset($file_path) ? $file_path : $konter->thumbnail;
        if ($konter->save()) {

            return redirect()->back()->with('success', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()->with('danger', 'Gagal menambahkan data');
        }
    }
    public function destroy($id)
    {
        $konter = Konter::find($id);
        if ($konter->thumbnail != '') {
            Storage::delete($konter->thumbnail);
        }
        $konter->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
