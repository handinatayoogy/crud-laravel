<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::all();
        return view('main', compact('mahasiswas'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nim' => 'required|string|max:8|unique:mahasiswas',
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'ipk' => 'required|numeric|between:0.00,4.00',
        ]);

        $mahasiswa = new Mahasiswa;
        $mahasiswa->nim = $request->nim;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->tanggal_lahir = $request->tanggal_lahir;
        $mahasiswa->ipk = $request->ipk;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = $request->nim . '.' . $extension;
            $file->storeAs('public/foto', $filename);
            $mahasiswa->foto = $filename;
        }

        $mahasiswa->save();

        return redirect('/mahasiswa')->with('status', 'Data mahasiswa berhasil ditambahkan!');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $this->validate($request, [
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nim' => 'string|max:8',
            'nama' => 'string|max:255',
            'tanggal_lahir' => 'date',
            'ipk' => 'numeric|between:0.00,4.00',
        ]);

        $mahasiswa = Mahasiswa::findOrFail($mahasiswa->id);

        if ($request->file('foto') == "") {
            $mahasiswa->update([
                'nim' => $request->nim,
                'nama' => $request->nama,
                'tanggal_lahir' => $request->tanggal_lahir,
                'ipk' => $request->ipk,
            ]);
        } else {
            Storage::disk('public')->delete('foto/' . $mahasiswa->foto);

            $foto = $request->file('foto');
            $foto->storeAs('public/foto', $foto->hashName());

            $mahasiswa->update([
                'foto' => $foto->hashName(),
                'nim' => $request->nim,
                'nama' => $request->nama,
                'tanggal_lahir' => $request->tanggal_lahir,
                'ipk' => $request->ipk,
            ]);
        }

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diubah');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        Storage::disk('public')->delete('foto/' . $mahasiswa->foto);
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus');
    }
}
