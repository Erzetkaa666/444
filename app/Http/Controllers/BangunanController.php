<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bangunan;
use App\Models\Tanah;

class BangunanController extends Controller
{
    public function __construct()
    {
        $this->middleware(\App\Http\Middleware\IsAdmin::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
    }
    public function index() {
        $bangunan = Bangunan::all();
        return view('bangunan.index', ['items' => $bangunan]);
    }

    public function create()
    {
        $tanahs = Tanah::all();
        return view('bangunan.create', ['tanahs' => $tanahs]);
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
        $bangunan = Bangunan::findOrFail($id);
        $tanahs = Tanah::all();
        return view('bangunan.edit', ['bangunan' => $bangunan, 'tanahs' => $tanahs]);
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