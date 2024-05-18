@extends('layout')
@section('content')
    <div class="flex flex-col gap-6 p-6 font-sans ">
        <h1 class=" font-bold font-sans text-2xl">Ujian</h1>
        <a href="/ujian/create" class="px-4 py-2 text-white rounded bg-blue-500 w-min">CREATE</a>
        <div class=" flex flex-col gap-4">
            <div class=" flex flex-col w-full bg-white shadow-lg border border-gray-300 rounded p-6 gap-4">
                <h1 class=" font-bold font-sans text-2xl">SIMPER</h1>
                <div class="flex flex-row w-full gap-4">
                    @foreach ($ujian as $item)
                        @if ($item->id_jenis_ujian == 1)
                            <a href="/ujian/{{ $item->id }}"
                                class="pl-2 pr-12 pt-2 pb-24 text-xl font-bold text-white rounded rounded-tr-3xl bg-orange-500 w-min hover:bg-orange-800">{{ $item->nama }}</a>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class=" flex flex-col w-full bg-white shadow-lg border border-gray-300 rounded p-6 gap-4">
                <h1 class=" font-bold font-sans text-2xl">SIOPER</h1>
                <div class="flex flex-row w-full gap-4">
                    @foreach ($ujian as $item)
                        @if ($item->id_jenis_ujian == 2)
                            <a href="/ujian/{{ $item->id }}"
                                class="pl-2 pr-12 pt-2 pb-24 text-xl font-bold text-white rounded rounded-tr-3xl bg-blue-500 w-min hover:bg-blue-800">{{ $item->nama }}</a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>


    </div>
    @vite('resources/js/pengajuansimperIndex.js')
@endsection
