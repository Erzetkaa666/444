<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;
use App\Models\Bangunan;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::with('bangunan')->get();
        return view('ruangan.index', ['items' => $ruangans]);
    }

    public function create()
    {
        $bangunans = Bangunan::all();
        return view('ruangan.create', ['bangunans' => $bangunans]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_ruangan' => 'required|string',
            'kode_ruangan' => 'required|string',
            'bangunan_id' => 'required|exists:bangunans,id',
        ]);

        Ruangan::create($validated);
        return redirect()->route('ruangan.index')->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function show(string $id)
    {
        // optionally implement if needed
    }

    public function edit(string $id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $bangunans = Bangunan::all();
        return view('ruangan.edit', ['ruangan' => $ruangan, 'bangunans' => $bangunans]);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_ruangan' => 'required|string',
            'kode_ruangan' => 'required|string',
            'bangunan_id' => 'required|exists:bangunans,id',
        ]);

        Ruangan::where('id', $id)->update($validated);
        return redirect()->route('ruangan.index')->with('success', 'Data Berhasil Diupdate!');
    }

    public function destroy(string $id)
    {
        Ruangan::destroy($id);
        return redirect()->route('ruangan.index')->with('success', 'Data Berhasil Dihapus!');
    }
}
