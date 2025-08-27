<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BangunanController extends Controller
{
    public function index() {
        $bangunan = Bangunan::all();
        return view('bangunan.index', ['items' => $bangunan]);
    }

    public function create()
    {
        return view('bangunan.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'nama_bangunan' => 'required|string',
            'kode_bangunan' => 'required|string',
            'tanah_id' => 'required|string',
        ]);

        Bangunan::create($validated);
        return redirect()->route('bangunan.index')->with('success', 'Data Berhasil Ditambahkan!');
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
        $bangunan = Bangunan::find($id);
        return view('bangunan.edit', ['bangunan'=>$bangunan]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_bangunan' => 'required|string',
            'kode_bangunan' => 'required|string',
            'tanah_id' => 'required|string',
        ]);

        Bangunan::where('id', $id)->update($validated);
        return redirect()->route('bangunan.index')->with('success', 'Data Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Bangunan::destroy($id);
        return redirect()->route('bangunan.index')->with('success', 'Data Berhasil Dihapus!');
    }
}