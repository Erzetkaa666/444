<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;
use App\Models\Bangunan;

class RuanganController extends Controller
{
    //
    public function index()
    {
        $ruangans = Ruangan::all();
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
            'kode_ruangan' => 'required|string|unique:ruangans,kode_ruangan',
            'bangunan_id' => 'required|exists:bangunans,id',
        ]);

        Ruangan::create($validated);
        return redirect()->route('ruangan.index')->with('success', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ruangan = Ruangan::find($id);
        $bangunans = Bangunan::all();
        return view('ruangan.edit', ['ruangan' => $ruangan, 'bangunans' => $bangunans]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_ruangan' => 'required|string',
            'kode_ruangan' => 'required|string|unique:ruangans,kode_ruangan,' . $id,
            'bangunan_id' => 'required|exists:bangunans,id',
        ]);

        $ruangan = Ruangan::find($id);
        $ruangan->update($validated);
        return redirect()->route('ruangan.index')->with('success', 'Data Berhasil Dirubah!');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Ruangan::destroy($id);
        return redirect()->route('ruangan.index')->with('success', 'Data Berhasil Dihapus!');
    }
}
