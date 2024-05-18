@extends('layout')
@section('content')
    <div class="flex flex-col gap-6 p-6 ">
        <h1 class=" font-bold font-mon text-2xl">Pengajuan STIKER anda</h1>
        @if (session()->has('success'))
            <p class=" font-semibold text-xl p-6 w-full bg-green-500 rounded">{{ session('success') }}
            </p>
        @endif
        <a href="{{route('pengajuanstiker.create')}}" class="px-4 py-2 text-white rounded bg-blue-500 w-min">CREATE</a>
        <div id="gridContainer"></div>
    </div>
    @vite('resources/js/pengajuanStikerIndex.js')
@endsection