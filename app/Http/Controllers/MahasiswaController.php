<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index(){
        $mahasiswas = Mahasiswa::all();
        return view('dashboard', compact('mahasiswas'));
    }

    public function store(Request $request){
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:255|unique:mahasiswas',
        ]);

        $notifications = [
            'message' => 'Data mahasiswa berhasil ditambahkan',
            'alert-type' => 'success'
        ];

        Mahasiswa::create($request->all());

        return redirect()->route('dashboard')->with($notifications);
    }

    public function destroy($id){ 
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        $notifications = [
            'message' => 'Data mahasiswa berhasil dihapus',
            'alert-type' => 'warning'
        ];

        return redirect()->route('dashboard')->with($notifications);
    }
    public function update(Request $request , $id){ 
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa -> nama = $request->nama;
        $mahasiswa -> nim = $request->nim;
        $mahasiswa->save();

        $notifications = [
            'message' => 'Data mahasiswa berhasil diupdate',
            'alert-type' => 'success'
        ];

        return redirect()->route('dashboard')->with($notifications);
    }
}