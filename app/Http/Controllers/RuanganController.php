<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;
use App\Models\Bangunan;

class RuanganController extends Controller
{
<<<<<<< HEAD
    public function index()
    {
        $ruangans = Ruangan::with('bangunan')->get();
=======
    //
    public function index()
    {
        $ruangans = Ruangan::all();
>>>>>>> eab064c8df27f26ca1055c166db3d6bbf0fff1ec
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
<<<<<<< HEAD
            'kode_ruangan' => 'required|string',
=======
            'kode_ruangan' => 'required|string|unique:ruangans,kode_ruangan',
>>>>>>> eab064c8df27f26ca1055c166db3d6bbf0fff1ec
            'bangunan_id' => 'required|exists:bangunans,id',
        ]);

        Ruangan::create($validated);
        return redirect()->route('ruangan.index')->with('success', 'Data Berhasil Ditambahkan!');
    }

<<<<<<< HEAD
    public function show(string $id)
    {
        // optionally implement if needed
    }

    public function edit(string $id)
    {
        $ruangan = Ruangan::findOrFail($id);
=======
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
>>>>>>> eab064c8df27f26ca1055c166db3d6bbf0fff1ec
        $bangunans = Bangunan::all();
        return view('ruangan.edit', ['ruangan' => $ruangan, 'bangunans' => $bangunans]);
    }

<<<<<<< HEAD
=======
    /**
     * Update the specified resource in storage.
     */
>>>>>>> eab064c8df27f26ca1055c166db3d6bbf0fff1ec
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_ruangan' => 'required|string',
<<<<<<< HEAD
            'kode_ruangan' => 'required|string',
            'bangunan_id' => 'required|exists:bangunans,id',
        ]);

        Ruangan::where('id', $id)->update($validated);
        return redirect()->route('ruangan.index')->with('success', 'Data Berhasil Diupdate!');
    }

=======
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
>>>>>>> eab064c8df27f26ca1055c166db3d6bbf0fff1ec
    public function destroy(string $id)
    {
        Ruangan::destroy($id);
        return redirect()->route('ruangan.index')->with('success', 'Data Berhasil Dihapus!');
    }
}
