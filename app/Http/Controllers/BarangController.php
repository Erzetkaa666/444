<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Barang;
use App\Models\Ruangan;
use App\Models\Kategori;
use App\Models\Activity;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::with(['ruangan', 'kategori'])->get();
        return view('barang.index', ['items' => $barangs]);
    }

    public function create()
    {
        $ruangans = Ruangan::all();
        $kategoris = Kategori::all();
        return view('barang.create', ['ruangans' => $ruangans, 'kategoris' => $kategoris]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string',
            'kode_inventaris' => 'required|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'ruangan_id' => 'required|exists:ruangans,id',
            'tahun_pengadaan' => 'nullable|integer',
            'sumber_dana' => 'nullable|string',
            'kondisi' => 'nullable|string',
        ]);

        $barang = Barang::create($validated);

        // log activity
        Activity::create([
            'description' => "Menambah barang: {$barang->nama_barang}",
            'user_id' => Auth::id(),
            'status' => 'created',
        ]);

        return redirect()->route('barang.index')->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function show(string $id)
    {
        // optionally implement if needed
    }

    public function edit(string $id)
    {
        $barang = Barang::findOrFail($id);
        $ruangans = Ruangan::all();
        $kategoris = Kategori::all();
        return view('barang.edit', ['barang' => $barang, 'ruangans' => $ruangans, 'kategoris' => $kategoris]);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string',
            'kode_inventaris' => 'required|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'ruangan_id' => 'required|exists:ruangans,id',
            'tahun_pengadaan' => 'nullable|integer',
            'sumber_dana' => 'nullable|string',
            'kondisi' => 'nullable|string',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($validated);

        Activity::create([
            'description' => "Memperbarui barang: {$barang->nama_barang}",
            'user_id' => Auth::id(),
            'status' => 'updated',
        ]);

        return redirect()->route('barang.index')->with('success', 'Data Berhasil Diupdate!');
    }

    public function destroy(string $id)
    {
        $barang = Barang::findOrFail($id);
        $nama = $barang->nama_barang;
        $barang->delete();

        Activity::create([
            'description' => "Menghapus barang: {$nama}",
            'user_id' => Auth::id(),
            'status' => 'deleted',
        ]);

        return redirect()->route('barang.index')->with('success', 'Data Berhasil Dihapus!');
    }
}
