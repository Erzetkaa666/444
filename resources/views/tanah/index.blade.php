@extends('layouts.app')

@section('title', 'Data Tanah')

@section('content')

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
    background-color: #121212;
    color: #f1f1f1;
    padding: 30px;
}

.header {
    background-color: #1e1e1e;
    height: 60px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 1.5rem;
    position: relative;
    z-index: 20;
}

a[href*="create"] {
    display: inline-block;
    background-color: #0097a7;
    color: #ffffff;
    padding: 8px 14px;
    border-radius: 6px;
    text-decoration: none;
    margin-top: 10px;
    transition: background-color 0.25s ease;
}
a[href*="create"]:hover {
    background-color: #00848f;
}

.table-wrapper {
    width: 100%;
    display: flex;
    justify-content: center;
    margin-top: 18px;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

table {
    width: 90%;
    max-width: 1000px;
    margin: 0 auto;
    border-collapse: collapse;
    background-color: #1c1c1c;
    box-shadow: 0 2px 10px rgba(0,0,0,0.5);
    border-radius: 8px;
    overflow: hidden;
    min-width: 800px; 
    table-layout: fixed;
}

thead th {
    padding: 14px 15px;
    background-color: #292929;
    color: #f1f1f1;
    font-weight: 700;
    text-align: center;
    border-bottom: 1px solid #2f2f2f;
    font-size: 0.95rem;
}

tbody td {
    padding: 12px 15px;
    border: 1px solid #333;
    text-align: center;
    vertical-align: middle;
    font-size: 0.95rem;
    word-wrap: break-word;
}

tbody tr:nth-child(even) {
    background-color: #232323;
}
tbody tr:hover {
    background-color: #303030;
}

td a {
    display: inline-block;
    padding: 6px 10px;
    color: white;
    border-radius: 4px;
    text-decoration: none;
    margin: 0 4px;
    font-size: 13px;
    transition: transform 0.12s ease, opacity 0.12s ease;
}
td a:active { transform: translateY(1px); }

td a[href*="edit"] {
    background-color: #0097a7;
}
td a[href*="edit"]:hover {
    background-color: #00848f;
}

td form button[type="submit"] {
    background-color: #e74c3c;
    color: white;
    border: none;
    padding: 6px 10px;
    border-radius: 4px;
    font-size: 13px;
    cursor: pointer;
}
td form button[type="submit"]:hover {
    background-color: #c0392b;
}

td form {
    display: inline-block;
    margin: 0;
}

.center {
    display: block;
    text-align: center;
    margin-bottom: 12px;
}

h2 {
    font-size: 28px;
    color: #ffffff;
    margin-bottom: 20px;
}

input[type="text"], select {
    padding: 8px 12px;
    width: 240px;
    border: 1px solid #444;
    background-color: #1f1f1f;
    color: #f1f1f1;
    border-radius: 6px;
    transition: 0.3s;
}
input[type="text"]:focus {
    border-color: #00adb5;
    outline: none;
}

@media (max-width: 768px) {
    body { padding: 15px; }
    table { min-width: 700px; }
}
</style>

<div>
    <a href="{{ route('tanah.create') }}">Tambah</a>
</div>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Tanah</th>
            <th>Kode Tanah</th>
            <th>Luas</th>
            <th>No Sertifikat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama_tanah }}</td>
            <td>{{ $item->kode_tanah }}</td>
            <td>{{ $item->luas }}</td>
            <td>{{ $item->no_sertifikat }}</td>
            <td>
                <a href="{{ route('tanah.edit', $item->id) }}">Edit</a>
                <form action="{{ route('tanah.destroy', $item->id) }}" method="post">
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