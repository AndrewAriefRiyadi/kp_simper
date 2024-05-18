@extends('layout')

@section('content')
    <div class="container flex flex-col p-6 gap-4">
        <h2 class="text-2xl font-semibold pb-4">Result Ujian:</h2>
        <p>Nilai = {{$pusim->nilai}}</p>
        @if (count($soals) > 0)
            <form id="simulasiForm" action="/simpan_jawaban" method="post">
                @csrf
                <div id="simulasi">
                    @foreach ($soals as $index => $soal)
                        <div class="soal flex flex-col gap-4 bg-gray-300 rounded p-6" id="soal-{{ $soal->id }}">
                            <h3 class="font-semibold text-md">Soal {{ $soals->currentPage() }}</h3>
                            <p class="text-xl">{{ $soal->teks }}</p>
                            @foreach ($soal->jawabans as $jawaban)
                                @php
                                    // Check if any item in $moduls matches the current answer's ID
                                    $isSelected = $moduls->contains('id_jawaban', $jawaban->id);
                                    // Variabel yang berisi nilai antara 1 dan 0 (misalnya dari database)
                                    $nilaiBenar = $jawaban->value; // Sesuaikan dengan atribut yang sesuai pada model Jawaban
                                @endphp

                                <label
                                    class="bg-gray-100 w-full rounded py-4 px-2 {{ $isSelected ? ($nilaiBenar ? 'bg-green-500 text-black' : 'bg-red-500 text-white') : '' }}">
                                    <input disabled type="radio" name="jawaban" value="{{ $jawaban->id }}"
                                        {{ $isSelected ? 'checked' : '' }}>
                                    {{ $jawaban->teks }}
                                </label>
                                <input type="hidden" name="id_soal" id="id_soal" value="{{ $soal->id }}">
                            @endforeach
                        </div>
                    @endforeach
                </div>

                <!-- Tambahkan input tersembunyi untuk menyimpan nomor halaman -->
                <input type="hidden" name="halaman" id="halaman" value="1">
                <input type="hidden" name="id_pusim" id="id_pusim" value="{{ $pusim->id }}">
            </form>
            <!-- Paginasi -->
            <div class="flex flex-row justify-between">
                <div class="">{{ $soals->links() }}</div>
                <a href="/pengajuansimper/{{ $pusim->id_pengajuan_simper }} "
                    class="px-4 py-2 text-white rounded bg-blue-500 w-min">Keluar</a>
            </div>
        @else
            <p>Tidak ada soal untuk simulasi ini.</p>
        @endif
    </div>
@endsection
