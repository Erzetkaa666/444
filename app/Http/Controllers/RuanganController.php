<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;
use App\Models\Bangunan;

class RuanganController extends Controller
{
    public function __construct()
    {
        $this->middleware(\App\Http\Middleware\IsAdmin::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
    }
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
            'nama_ruangan'   => 'required|string',
            'kode_ruangan'   => 'required|string|unique:ruangans,kode_ruangan',
            'bangunan_id'    => 'required|exists:bangunans,id',
        ]);

        Ruangan::create($validated);

        return redirect()->route('ruangan.index')
            ->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function edit(string $id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $bangunans = Bangunan::all();

        return view('ruangan.edit', [
            'ruangan'   => $ruangan,
            'bangunans' => $bangunans
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_ruangan'   => 'required|string',
            'kode_ruangan'   => 'required|string|unique:ruangans,kode_ruangan,' . $id,
            'bangunan_id'    => 'required|exists:bangunans,id',
        ]);

        $ruangan = Ruangan::findOrFail($id);
        $ruangan->update($validated);

        return redirect()->route('ruangan.index')
            ->with('success', 'Data Berhasil Diupdate!');
    }

    public function destroy(string $id)
    {
        Ruangan::destroy($id);

        return redirect()->route('ruangan.index')
            ->with('success', 'Data Berhasil Dihapus!');
    }
}
