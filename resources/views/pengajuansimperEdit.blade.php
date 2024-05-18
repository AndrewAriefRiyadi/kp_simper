@extends('layout')
@section('content')
    <form enctype="multipart/form-data" action="/pengajuansimper/{{ $psimper->id }}/edit" method="POST">
        @csrf
        @method('PUT')
        <div class= " p-6 flex flex-row">
            <div class= " p-6 flex flex-col justify-center bg-white gap-4 w-full font-semibold rounded shadow-xl">
                @if (session()->has('Error'))
                    <p>{{ session('Error') }}</p>
                @endif
                @if (session()->has('success'))
                    <p class=" font-semibold text-xl p-6 w-full bg-orange-500 text-white rounded">{{ session('success') }}
                    </p>
                @endif
                <div class="flex flex-row py-4 items-center gap-3">
                    <a href="{{ route('pengajuansimper.index') }}"><i
                            class="fas fa-chevron-left text-blue-500 text-2xl self-center"></i></a>
                    <h1 class=" font-bold font-sans text-2xl ">Pengajuan SIMPER/SIO </h1>
                </div>
                <div class=" bg-yellow-400 flex flex-col gap-4 m-6 p-4 rounded no-tailwindcss-base">
                    <h1 class=" font-bold text-2xl ">Revisi</h1>
                    @if ($psimper->keterangan_revisi == null)
                        <p class=" font-bold text-md "> Berkas anda perlu direvisi.
                        </p>
                    @else
                        {!! $psimper->keterangan_revisi !!}
                    @endif
                </div>
                <label class="block text-lg font-bold w-full text-blue-500">Jenis Pengajuan</label>
                <div class="flex flex-row justify-between items-center gap-24">
                    <div class="flex flex-col gap-2 w-full">
                        <p class=" w-full">Perihal</p>
                        <select name="perihal" id="perihalSelect"
                            class=" block bg-gray-100 text-gray-700 border border-gray-300 rounded  px-4 h-12 w-full leading-tight">
                            <option value="SIMPER" {{ $psimper->perihal == 'SIMPER' ? 'selected' : '' }}>SIMPER</option>
                            <option value="SIO" {{ $psimper->perihal == 'SIO' ? 'selected' : '' }}>SIO</option>
                        </select>
                    </div>
                    <div class="flex flex-col gap-2 w-full">

                        <p class=" w-full">Jenis Pengajuan</p>
                        <select name="id_jenis_pengajuan" id="jenisSelect"
                            class=" block bg-gray-100 text-gray-700 border border-gray-300 rounded  px-4 h-12 w-full leading-tight">
                            <option value="1" {{ $psimper->id_jenis_pengajuan == 1 ? 'selected' : '' }}>Pembuatan
                            </option>
                            <option value="2" {{ $psimper->id_jenis_pengajuan == 2 ? 'selected' : '' }}>Pembaruan
                            </option>
                        </select>
                    </div>
                </div>
                <label class="block text-lg font-bold w-full text-blue-500">Biodata</label>
                <div class="flex flex-row justify-between items-center gap-24">
                    <div class="flex flex-col gap-2 w-full">
                        <p class=" w-full">Diterima Tanggal</p>
                        <input
                            class="appearance-none block bg-gray-100 text-gray-700 border border-gray-300 rounded  px-4 h-12 w-full leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-300"
                            id="diterima_tgl" name="diterima_tgl" type="date" placeholder="01/01/2024"
                            value="{{ $psimper->diterima_tgl }}" required>
                    </div>
                    <div class="flex flex-col gap-2 w-full ">
                        <p class=" w-full">Nama</p>
                        <input
                            class="appearance-none block bg-gray-100 text-gray-700 border border-gray-300 rounded  px-4 h-12 w-full leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-300"
                            id="nama" name="nama" type="text" placeholder="Ronaldo" value="{{ $psimper->nama }}"
                            required>
                    </div>
                </div>
                <div class="flex flex-row justify-between items-center gap-24">
                    <div class="flex flex-col gap-2 w-full">
                        <p class=" w-full">Dari</p>
                        <input
                            class="appearance-none block bg-gray-100 text-gray-700 border border-gray-300 rounded  px-4 h-12 w-full leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-300"
                            id="dari" name="dari" type="text" placeholder="PT.KPI" value="{{ $psimper->dari }}"
                            required>
                    </div>
                    <div class="flex flex-col gap-2 w-full">
                        <p class=" w-full">No. Badge</p>
                        <input
                            class="appearance-none block bg-gray-100 text-gray-700 border border-gray-300 rounded  px-4 h-12 w-full leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-300"
                            id="no_badge" name="no_badge" type="number" placeholder="25" value="{{ $psimper->no_badge }}"
                            required>
                    </div>
                </div>

                <div class="flex flex-row justify-between items-center gap-24">
                    <div class="flex flex-col gap-2 w-full">
                        <p class=" w-full">No. Surat</p>
                        <input
                            class="appearance-none block bg-gray-100 text-gray-700 border border-gray-300 rounded  px-4 h-12 w-full leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-300"
                            id="no_surat" name="no_surat" type="number" placeholder="123"
                            value="{{ $psimper->no_surat }}" required>
                    </div>
                    <div class="flex flex-col gap-2 w-full">
                        <p class=" w-full">No. Agenda</p>
                        <input
                            class="appearance-none block bg-gray-100 text-gray-700 border border-gray-300 rounded  px-4 h-12 w-full leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-300"
                            id="no_agenda" name="no_agenda" type="number" placeholder="123"
                            value="{{ $psimper->no_agenda }}" required>
                    </div>
                </div>
                <div id="contJenisSimper" class="flex flex-row justify-between items-center gap-24">
                    <div class="flex flex-col gap-2 w-full">
                        <p class=" w-full">Jenis Simper</p>
                        <input
                            class="appearance-none block bg-gray-100 text-gray-700 border border-gray-300 rounded  px-4 h-12 w-full leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-300"
                            id="jenis_simper" name="jenis_simper" type="text" placeholder="Mobil"
                            value="{{ $psimper->jenis_simper }}">
                    </div>
                    <div class="flex flex-col gap-2 w-full">

                    </div>
                </div>
                <div class="flex flex-row justify-between gap-24 py-6">
                    <div class="flex flex-col gap-6 w-1/2">
                        <label class="block text-lg font-bold w-full text-blue-500">BERKAS</label>
                        <p class="block text-md font-semibold w-full text-red-500">Kosongkan jika tidak perlu mengganti
                            berkas.</p>
                        <div class="flex flex-col gap-2 w-full">
                            <label for="file" class="block text-sm font-medium text-gray-600">Surat Permohonan </label>
                            <input type="file" name="surat_permohonan" id="surat_permohonan"
                                accept=".pdf, .jpg, .jpeg, .png"
                                class="  px-4 py-2 border border-gray-300 rounded-md w-full items-center">
                            @if ($psimper->surat_permohonan)
                                <a href="#" class=" text-blue-400 underline"
                                    onclick="openModal('{{ str_replace('berkas/', '', $psimper->surat_permohonan) }}')">
                                    File Terkini: Surat Permohonan</a>
                            @else
                                <p>Belum ada file terkini.</p>
                            @endif
                        </div>
                        <div class="flex flex-col gap-2 w-full">
                            <label for="file" class="block text-sm font-medium text-gray-600 w-full">Copy Simpol / SIO
                                Depnaker </label>
                            <input type="file" name="simpol" id="simpol" accept=".pdf, .jpg, .jpeg, .png"
                                class="  px-4 py-2 border border-gray-300 rounded-md w-full items-center">
                            <p class=" text-xs text-blue-400 font-bold"> SIMPER = SIMPOL | SIO = SIO DEPNAKER</p>
                            @if ($psimper->simpol)
                                <a href="#" class=" text-blue-400 underline"
                                    onclick="openModal('{{ str_replace('berkas/', '', $psimper->simpol) }}')">
                                    File Terkini: SIMPOL</a>
                            @else
                                <p>Belum ada file terkini.</p>
                            @endif
                        </div>
                        <div class=" hidden flex flex-col gap-2 w-full" id="divSimperLama">
                            <label for="file" class="block text-sm font-medium text-gray-600 w-full">Copy Simper / SIO
                                Lama </label>
                            <input type="file" name="simper_lama" id="simper_lama" accept=".pdf, .jpg, .jpeg, .png"
                                class="  px-4 py-2 border border-gray-300 rounded-md w-full items-center">
                            <p class=" text-xs text-blue-400 font-bold"> SIMPER = SIMPER LAMA | SIO = SIO LAMA</p>
                            @if ($psimper->simper_lama)
                                <a href="#" class=" text-blue-400 underline"
                                    onclick="openModal('{{ str_replace('berkas/', '', $psimper->simper_lama) }}')">
                                    File Terkini: SIMPER LAMA</a>
                            @else
                                <p>Belum ada file terkini.</p>
                            @endif
                        </div>
                        <div class="flex flex-col gap-2 w-full">
                            <label for="file" class="block text-sm font-medium text-gray-600 w-full">Copy Badge
                            </label>
                            <input type="file" name="badge" id="badge" accept=".pdf, .jpg, .jpeg, .png"
                                class="  px-4 py-2 border border-gray-300 rounded-md w-full items-center">
                            @if ($psimper->badge)
                                <a href="#" class=" text-blue-400 underline"
                                    onclick="openModal('{{ str_replace('berkas/', '', $psimper->badge) }}')">
                                    File Terkini: Badge</a>
                            @else
                                <p>Belum ada file terkini.</p>
                            @endif
                        </div>
                        <div class="flex flex-col gap-2 w-full">
                            <label for="file" class="block text-sm font-medium text-gray-600 w-full">Copy SPK </label>
                            <input type="file" name="spk" id="spk" accept=".pdf, .jpg, .jpeg, .png"
                                class="  px-4 py-2 border border-gray-300 rounded-md w-full items-center">
                            @if ($psimper->spk)
                                <a href="#" class=" text-blue-400 underline"
                                    onclick="openModal('{{ str_replace('berkas/', '', $psimper->spk) }}')">
                                    File Terkini: SPK</a>
                            @else
                                <p>Belum ada file terkini.</p>
                            @endif
                        </div>
                    </div>
                    {{-- <div class="flex flex-col gap-6 w-1/2">
                        <label class="block text-lg font-bold w-full text-blue-500">KETERANGAN</label>
                        <div class="flex flex-row gap-4">
                            <label for="lengkap" class=" text-sm font-medium text-gray-600">Lengkap</label>
                            <input type="radio" name="keterangan" id="lengkap" value="Lengkap"
                                class=" px-4 py-2 border rounded-md w-6 h-6" {{ $psimper->keterangan == 'Lengkap' ? 'checked' : '' }}>
                        </div>
                        <div class="flex flex-row gap-4">
                            <label for="tidak_lengkap" class=" text-sm font-medium text-gray-600">Tidak
                                Lengkap</label>
                            <input type="radio" name="keterangan" id="tidak_lengkap" value="Tidak Lengkap"
                                class="px-4 py-2 border rounded-md w-6 h-6" checked {{ $psimper->keterangan == 'Tidak Lengkap' ? 'checked' : '' }}>
                        </div>
                        <div class="flex flex-row gap-4">
                            <label for="kadaluarsa" class="text-sm font-medium text-gray-600">Kadaluarsa</label>
                            <input type="radio" name="keterangan" id="kadaluarsa" value="Kadaluarsa"
                                class="px-4 py-2 border rounded-md w-6 h-6" {{ $psimper->keterangan == 'Kadaluarsa' ? 'checked' : '' }}>
                        </div>
                    </div> --}}
                </div>


                <button
                    class="shadow-xl bg-orange-500 hover:bg-orange-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                    type="submit">
                    Ajukan
                </button>
            </div>
        </div>
    </form>
    <div id="popupModal"
        class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 p-16">
        <div class="bg-black rounded-md w-full h-full">
            <!-- Konten modal -->
            {{-- <embed id="fileViewer" type="application/pdf" class="w-full h-full"/> --}}
            <iframe id="fileViewer" type="application/pdf" class="w-full h-full"></iframe>
            <a id="downloadButton" class="mt-2 bg-green-500 text-white px-4 py-2 rounded-md" target="_blank"
                rel="noopener noreferrer">Download</a>
            <button onclick="closeModal()" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-md">Close</button>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk jenisSelect
            const jenisSelect = document.getElementById('jenisSelect');
            const contJenisSimper = document.getElementById('contJenisSimper');
            const divSimperLama = document.getElementById('divSimperLama');
            const jenisSimperInput = document.getElementById('jenis_simper');
    
            function updateJenisSimperVisibility(selectedValue) {
                if (selectedValue === '1') {
                    divSimperLama.classList.add('hidden');
                    jenisSimperInput.required = true;
                } else if (selectedValue === '2') {
                    contJenisSimper.classList.add('hidden');
                    divSimperLama.classList.remove('hidden');
                    jenisSimperInput.required = false;
                }
            }
    
            jenisSelect.addEventListener('change', function() {
                updateJenisSimperVisibility(this.value);
            });
    
            // Fungsi untuk perihalSelect
            const perihalSelect = document.getElementById('perihalSelect');
    
            function updatePerihalVisibility(selectedValue) {
                if (selectedValue === 'SIMPER') {
                    contJenisSimper.classList.remove('hidden');
                    jenisSimperInput.required = true;
                } else if (selectedValue === 'SIO') {
                    contJenisSimper.classList.add('hidden');
                    jenisSimperInput.required = false;
                }
            }
    
            perihalSelect.addEventListener('change', function() {
                updatePerihalVisibility(this.value);
            });
    
            // Set initial visibility
            updateJenisSimperVisibility(jenisSelect.value);
            updatePerihalVisibility(perihalSelect.value);
        });
    </script>
    
    {{-- <script>
        function openModal(filename) {
            event.preventDefault();
            console.log(filename)
            // Mendapatkan URL file berdasarkan nama file
            const fileUrl = '{{ asset('storage/berkas') }}/' + filename;
            console.log(fileUrl);
            // Menetapkan URL file pada elemen iframe
            document.getElementById('fileViewer').src = fileUrl;
            // Menampilkan modal
            document.getElementById('popupModal').classList.remove('hidden');

            document.getElementById('downloadButton').href = fileUrl;
        }

        function closeModal() {
            // Menyembunyikan modal
            document.getElementById('popupModal').classList.add('hidden');
            document.getElementById('fileViewer').src = 'about:blank';
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk jenisSelect
            document.getElementById('jenisSelect').addEventListener('change', function() {
                // Mendapatkan nilai terpilih dari dropdown
                var selectedValue = this.value;

                const fileInput = document.getElementById('simper_lama');
                fileInput.value = null;

                // Menampilkan elemen penjelasan yang sesuai dengan pilihan
                if (selectedValue === '1') {
                    document.getElementById('divSimperLama').classList.add('hidden');
                    fileInput.required = false;
                } else if (selectedValue === '2') {
                    document.getElementById('divSimperLama').classList.remove('hidden');
                    fileInput.required = true;
                }
            });

            // Fungsi untuk perihalSelect
            document.getElementById('perihalSelect').addEventListener('change', function() {
                // Mendapatkan nilai terpilih dari dropdown
                var selectedValue = this.value;

                const fileInput = document.getElementById('jenis_simper');
                fileInput.value = null;

                // Menampilkan elemen penjelasan yang sesuai dengan pilihan
                if (selectedValue === 'SIMPER') {
                    document.getElementById('contJenisSimper').classList.remove('hidden');
                    fileInput.required = true;
                } else if (selectedValue === 'SIO') {
                    document.getElementById('contJenisSimper').classList.add('hidden');
                    fileInput.required = false;
                }
            });
        });
    </script> --}}
@endsection
