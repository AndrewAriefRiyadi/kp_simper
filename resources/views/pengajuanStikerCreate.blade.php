@extends('layout')
@section('content')
    <form enctype="multipart/form-data" action="/pengajuanstiker/create" method="POST">
        @csrf
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
                    <a href="{{ route('pengajuanstiker.index') }}"><i
                            class="fas fa-chevron-left text-blue-500 text-2xl self-center"></i></a>
                    <h1 class=" font-bold font-sans text-2xl ">Pengajuan STIKER</h1>
                </div>
                <label class="block text-lg font-bold w-full text-blue-500">Jenis Pengajuan</label>
                <div class="flex flex-row justify-between items-center gap-24">
                    <div class="flex flex-col gap-2 w-full">
                        <p class=" w-full">Perihal</p>
                        <input
                            class="appearance-none block bg-gray-100 text-gray-700 border border-gray-300 rounded  px-4 h-12 w-full leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-300"
                            id="perihal" name="perihal" type="text" placeholder="KMPPS" required>
                    </div>
                    <div class="flex flex-col gap-2 w-full">
                        <p class=" w-full">Durasi</p>
                        <select name="id_durasi" id="durasiSelect"
                            class=" block bg-gray-100 text-gray-700 border border-gray-300 rounded  px-4 h-12 w-full leading-tight">
                            @foreach ($durasis as $durasi)
                                <option value="{{$durasi->id}}">{{$durasi->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <label class="block text-lg font-bold w-full text-blue-500">Biodata</label>
                <div class="flex flex-row justify-between items-center gap-24">
                    <div class="flex flex-col gap-2 w-full">
                        <p class=" w-full">Diterima Tanggal</p>
                        <input
                            class="appearance-none block bg-gray-100 text-gray-700 border border-gray-300 rounded  px-4 h-12 w-full leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-300"
                            id="diterima_tgl" name="diterima_tgl" type="date" placeholder="01/01/2024" required>
                    </div>
                    <div class="flex flex-col gap-2 w-full ">
                        <p class=" w-full">Nama</p>
                        <input
                            class="appearance-none block bg-gray-100 text-gray-700 border border-gray-300 rounded  px-4 h-12 w-full leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-300"
                            id="nama" name="nama" type="text" placeholder="Ronaldo" required>
                    </div>
                </div>
                <div class="flex flex-row justify-between items-center gap-24">
                    <div class="flex flex-col gap-2 w-full">
                        <p class=" w-full">Dari</p>
                        <input
                            class="appearance-none block bg-gray-100 text-gray-700 border border-gray-300 rounded  px-4 h-12 w-full leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-300"
                            id="dari" name="dari" type="text" placeholder="PT.KPI" required>
                    </div>
                    <div class="flex flex-col gap-2 w-full">
                        <p class=" w-full">No. Surat</p>
                        <input
                            class="appearance-none block bg-gray-100 text-gray-700 border border-gray-300 rounded  px-4 h-12 w-full leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-300"
                            id="no_surat" name="no_surat" type="number" placeholder="123" required>
                    </div>
                </div>

                <div class="flex flex-row justify-between items-center gap-24">
                    <div class="flex flex-col gap-2 w-full">
                        <p class=" w-full">No. Agenda</p>
                        <input
                            class="appearance-none block bg-gray-100 text-gray-700 border border-gray-300 rounded  px-4 h-12 w-full leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-300"
                            id="no_agenda" name="no_agenda" type="number" placeholder="123" required>
                    </div>
                    <div class="flex flex-col gap-2 w-full">
                        <p class=" w-full">No. Badge</p>
                        <input
                            class="appearance-none block bg-gray-100 text-gray-700 border border-gray-300 rounded  px-4 h-12 w-full leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-300"
                            id="no_badge" name="no_badge" type="number" placeholder="123" required>
                    </div>
                </div>
                <div class="flex flex-row justify-between gap-24 py-6">
                    <div class="flex flex-col gap-6 w-1/2">
                        <label class="block text-lg font-bold w-full text-blue-500">BERKAS</label>
                        <div class="flex flex-col gap-2 w-full">
                            <label for="file" class="block text-sm font-medium text-gray-700">Surat Permohonan </label>
                            <input type="file" name="surat_permohonan" id="surat_permohonan"
                                accept=".pdf, .jpg, .jpeg, .png"
                                class="  px-4 py-2 border border-gray-300 bg-gray-100 rounded-md w-full items-center" required>
                        </div>
                        <div class="flex flex-col gap-2 w-full">
                            <label for="file" class="block text-sm font-medium text-gray-700 w-full">SPK / Surat Keterangan Diketahui User
                                Depnaker </label>
                            <input type="file" name="spk" id="spk" accept=".pdf, .jpg, .jpeg, .png"
                                class="  px-4 py-2 border border-gray-300 bg-gray-100 rounded-md w-full items-center" required>
                        </div>
                        <div class="flex flex-col gap-2 w-full">
                            <label for="file" class="block text-sm font-medium text-gray-700 w-full">STNK / Copy Re-Sertifikasi / Copy Ket Disnaker
                            <input type="file" name="stnk" id="stnk" accept=".pdf, .jpg, .jpeg, .png"
                                class="  px-4 py-2 border border-gray-300 bg-gray-100 rounded-md w-full items-center" required>
                        </div>
                        <div class="flex flex-col gap-2 w-full">
                            <label for="file" class="block text-sm font-medium text-gray-700 w-full">Copy SIMPOL / SIMPER / SIOPER / SIO Disnaker </label>
                            <input type="file" name="simpol" id="simpol" accept=".pdf, .jpg, .jpeg, .png"
                                class="  px-4 py-2 border border-gray-300 bg-gray-100 rounded-md w-full items-center" required>
                        </div>
                        <div class="flex flex-col gap-2 w-full">
                            <label for="file" class="block text-sm font-medium text-gray-700 w-full">Badge / Pas Harian</label>
                            <input type="file" name="badge" id="badge" accept=".pdf, .jpg, .jpeg, .png"
                                class="  px-4 py-2 border border-gray-300 bg-gray-100 rounded-md w-full items-center" required>
                        </div>
                        <div class="flex flex-col gap-2 w-full">
                            <label for="file" class="block text-sm font-medium text-gray-700 w-full">Buku KIR Kend</label>
                            <input type="file" name="buku" id="buku" accept=".pdf, .jpg, .jpeg, .png"
                                class="  px-4 py-2 border border-gray-300 bg-gray-100 rounded-md w-full items-center" required>
                        </div>
                        <div class="flex flex-col gap-2 w-full">
                            <label for="file" class="block text-sm font-medium text-gray-700 w-full">Pajak Dispenda (Kend. Non KT-Ijin Operasi)</label>
                            <input type="file" name="pajak" id="pajak" accept=".pdf, .jpg, .jpeg, .png"
                                class="  px-4 py-2 border border-gray-300 bg-gray-100 rounded-md w-full items-center" required>
                        </div>
                    </div>
                    {{-- <div class="flex flex-col gap-6 w-1/2">
                        <label class="block text-lg font-bold w-full text-blue-500">KETERANGAN</label>
                        <div class="flex flex-row gap-4">
                            <label for="lengkap" class=" text-sm font-medium text-gray-700">Lengkap</label>
                            <input type="radio" name="keterangan" id="lengkap" value="Lengkap"
                                class=" px-4 py-2 border rounded-md w-6 h-6">
                        </div>
                        <div class="flex flex-row gap-4">
                            <label for="tidak_lengkap" class=" text-sm font-medium text-gray-700">Tidak
                                Lengkap</label>
                            <input type="radio" name="keterangan" id="tidak_lengkap" value="Tidak Lengkap"
                                class="px-4 py-2 border rounded-md w-6 h-6" checked>
                        </div>
                        <div class="flex flex-row gap-4">
                            <label for="kadaluarsa" class="text-sm font-medium text-gray-700">Kadaluarsa</label>
                            <input type="radio" name="keterangan" id="kadaluarsa" value="Lengkap"
                                class="px-4 py-2 border rounded-md w-6 h-6">
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
    <script>
        
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

        document.getElementById('perihalSelect').addEventListener('change', function() {
            // Mendapatkan nilai terpilih dari dropdown
            var selectedValue = this.value;

            const fileInput = document.getElementById('jenis_simper');
            fileInput.value = null;
            console.log(fileInput)
            // Menampilkan elemen penjelasan yang sesuai dengan pilihan
            if (selectedValue === 'SIMPER') {
                document.getElementById('contJenisSimper').classList.remove('hidden');
                fileInput.required = true;
                
            } else if (selectedValue === 'SIO') {
                document.getElementById('contJenisSimper').classList.add('hidden');
                fileInput.required = false;
            }
        });
    </script>
@endsection
