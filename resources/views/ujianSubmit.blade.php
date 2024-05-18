@extends('layout')
@section('content')
    <div class="flex flex-col gap-6 p-6 font-sans ">
        <h1 class=" font-bold font-sans text-2xl">Ujian Submitted</h1>
        <div class=" flex flex-col gap-4">
            <h1 class=" font-bold font-sans text-2xl">Anda mendapatkan Nilai</h1>
            <p>{{$pusim->nilai}}</p>
        </div>
        <a href="/pengajuansimper/{{$psimper->id}}" class="px-4 py-2 text-white rounded bg-blue-500 w-min">KEMBALI</a>
    </div>
    @vite('resources/js/pengajuansimperIndex.js')
@endsection