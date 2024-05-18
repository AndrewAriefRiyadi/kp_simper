@extends('layout')
@section('content')
    <h1>Data List</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kolom 1</th>
                <th>Nama Kolom 2</th>
                <!-- Tambahkan kolom sesuai dengan struktur tabel Anda -->
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->kolom2 }}</td>
                    <!-- Tambahkan kolom sesuai dengan struktur tabel Anda -->
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
