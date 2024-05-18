@extends('layout')

@section('content')
    <div class="container flex flex-col p-6 gap-4">
        <h2 class="text-2xl font-semibold pb-4">Simulasi Ujian: {{ $ujian->nama }}</h2>

        @if (count($soals) > 0)
            <form id="simulasiForm" action="/simpan_jawaban" method="post">
                @csrf
                <div id="simulasi">
                    @foreach ($soals as $index => $soal)
                        <div class="soal flex flex-col gap-4 bg-white shadow-lg rounded p-6" id="soal-{{ $soal->id }}">
                            <h3 class="font-semibold text-md">Soal {{ $soals->currentPage() }}</h3>
                            <p class="text-xl">{{ $soal->teks }}</p>
                            @foreach ($soal->jawabans as $jawaban)
                                @php
                                    // Check if any item in $moduls matches the current answer's ID
                                $isSelected = $moduls->contains('id_jawaban', $jawaban->id);
                                @endphp

                                <label class="bg-gray-200 border border-gray-300 w-full rounded py-4 px-2 hover:bg-gray-300">
                                    <input type="radio" name="jawaban" value="{{ $jawaban->id }}"
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
                <form action="/ujianSubmit/{{ $pusim->id }}" method="POST">
                    @csrf
                    <button id="submitBtn" type="submit" class="hidden h-full px-4 bg-blue-500 text-white rounded"> Submit</button>
                </form>
                
            </div>
        @else
            <p>Tidak ada soal untuk simulasi ini.</p>
        @endif
    </div>
    <script>
        $(document).ready(function() {
            $('form#simulasiForm').submit(function(event) {
                event.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: '/simpan_jawaban',
                    data: $(this).serialize(),
                    success: function(data) {
                        // Handle success response jika diperlukan
                        console.log('Jawaban berhasil disimpan.');
                    },
                    error: function(error) {
                        // Handle error response jika diperlukan
                        console.error('Terjadi kesalahan:', error);
                    }
                });
            });

            $('input[name="jawaban"]').change(function() {
                $('#simulasiForm').submit(); // Mengirim formulir secara otomatis
            });

            const itemsPerPage = 1; // Adjust this value based on your pagination settings
            const totalSoals = {{ $soals->total() }};
            const currentPage = {{ $soals->currentPage() }};

            const remainingItems = totalSoals - (currentPage - 1) * itemsPerPage;

            if (remainingItems <= itemsPerPage) {
                // Execute your logic for the last page
                console.log('This is the last page.');
                // For example, show the submit button
                $('#submitBtn').removeClass('hidden');
            }
        });
    </script>
@endsection
