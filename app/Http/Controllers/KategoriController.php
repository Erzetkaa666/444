<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;


class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware(\App\Http\Middleware\IsAdmin::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
    }
    public function index()
    {
        $kategoris = Kategori::all();
        return view('kategori.index', ['items' => $kategoris]);
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string',
        ]);

        Kategori::create($validated);
        return redirect()->route('kategori.index')->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function edit(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', ['kategori' => $kategori]);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string',
        ]);

        Kategori::where('id', $id)->update($validated);
        return redirect()->route('kategori.index')->with('success', 'Data Berhasil Diupdate!');
    }

    public function destroy(string $id)
    {
        Kategori::destroy($id);
        return redirect()->route('kategori.index')->with('success', 'Data Berhasil Dihapus!');
    }
}
