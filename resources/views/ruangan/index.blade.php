@extends('layouts.app')

@section('title', 'Data Ruangan')

@section('content')

<style>
    body {
        font-family: 'Inter', sans-serif;
        background: #f5f6fa;
    }

    /* Tombol Tambah */
    .add-btn {
        display: inline-block;
        padding: 10px 18px;
        background: linear-gradient(135deg, #4f46e5, #6366f1);
        color: white !important;
        font-weight: 600;
        text-decoration: none;
        border-radius: 10px;
        font-size: 14px;
        transition: 0.25s ease;
        box-shadow: 0 4px 10px rgba(99, 102, 241, 0.3);
    }

    .add-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(99, 102, 241, 0.45);
    }

    /* Table wrapper */
    table {
        width: 100%;
        margin-top: 25px;
        border-collapse: separate;
        border-spacing: 0;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }

    /* Header */
    thead tr {
        background: #eef2ff !important;
    }

    th {
        padding: 14px;
        font-size: 14px;
        font-weight: 700;
        color: #4f46e5;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    /* Body */
    td {
        padding: 14px;
        font-size: 14px;
        border-bottom: 1px solid #f1f1f1;
    }

    tbody tr:hover {
        background: #f9fafb;
    }

    /* Tombol Edit */
    td a {
        padding: 7px 14px;
        background: #f59e0b;
        color: white !important;
        text-decoration: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        transition: 0.25s ease;
        margin-right: 4px;
        display: inline-block;
    }

    td a:hover {
        background: #d97706;
        transform: translateY(-2px);
    }

    /* Tombol Hapus */
    td form button {
        padding: 7px 14px;
        background: #ef4444;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        font-size: 13px;
        transition: 0.25s ease;
        margin-left: 2px;
    }

    td form button:hover {
        background: #dc2626;
        transform: translateY(-2px);
    }
</style>

<div>
    <a href="{{ route('ruangan.create') }}" class="add-btn">Tambah</a>
</div>

<table class="table table-bordered mt-4">
    <thead>
        <tr class="table-secondary">
            <th>ID</th>
            <th>Nama Ruangan</th>
            <th>Kode Ruangan</th>
            <th>Bangunan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama_ruangan }}</td>
            <td>{{ $item->kode_ruangan }}</td>
            <td>{{ optional($item->bangunan)->nama_bangunan }}</td>
            <td>
                <a href="{{ route('ruangan.edit', $item->id) }}">Edit</a>
                <form action="{{ route('ruangan.destroy', $item->id) }}" method="post" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
