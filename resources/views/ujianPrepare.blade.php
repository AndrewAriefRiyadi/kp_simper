@extends('layout')
@section('content')
    <div class="flex flex-col gap-6 p-6 font-sans ">
        <a href="/pengajuansimper/{{$psimper->id}}"><i class="fas fa-chevron-left text-blue-500 text-2xl self-center"></i></a>
        <h1 class=" font-bold font-sans text-2xl">{{$psimper->nama}}</h1>
        <div class=" flex flex-col gap-4">
            @if (isset($ujian))
                <h1 class=" font-bold font-sans text-2xl">Anda akan mengerjakan ujian {{$ujian->nama}}</h1>
                @if ($pusim)
                    <p> Anda telah mengerjakan ujian, dan mendapatkan nilai {{$pusim->nilai}}</p>
                @endif

                @if ($soals <= 0)
                    <p> Maaf Soal belum siap dikerjakan</p>
                @else
                    <a href="/pengajuansimper/{{$psimper->id}}/ujian/simulasi" class="px-4 py-2 text-white rounded bg-blue-500 w-min">UJIAN</a> 
                @endif
            @else
                <h1 class=" font-bold font-sans text-2xl">Anda belum mendapatkan modul ujian.</h1>
            @endif
            
        </div>
    </div>
    @vite('resources/js/pengajuansimperIndex.js')
@endsection