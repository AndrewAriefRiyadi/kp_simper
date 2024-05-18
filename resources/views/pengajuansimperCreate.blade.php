@extends('layout')
@section('content')
    <form enctype="multipart/form-data" action="/pengajuansimperCreate" method="POST">
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
                    <a href="{{ route('pengajuansimper.index') }}"><i
                            class="fas fa-chevron-left text-blue-500 text-2xl self-center"></i></a>
                    <h1 class=" font-bold font-sans text-2xl ">Pengajuan SIMPER/SIO </h1>
                </div>
                <label class="block text-lg font-bold w-full text-blue-500">Jenis Pengajuan</label>
                <div class="flex flex-row justify-between items-center gap-24">
                    <div class="flex flex-col gap-2 w-full">
                        <p class=" w-full">Perihal</p>
                        <select name="perihal" id="perihalSelect"
                            class=" block bg-gray-100 text-gray-700 border border-gray-300 rounded  px-4 h-12 w-full leading-tight">
                            <option value="SIMPER">SIMPER</option>
                            <option value="SIO">SIO</option>
                        </select>
                    </div>
                    <div class="flex flex-col gap-2 w-full">
                        
                        <p class=" w-full">Jenis Pengajuan</p>
                        <select name="id_jenis_pengajuan" id="jenisSelect"
                            class=" block bg-gray-100 text-gray-700 border border-gray-300 rounded  px-4 h-12 w-full leading-tight">
                            <option value="1">Pembuatan</option>
                            <option value="2">Pembaruan</option>
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
                        <p class=" w-full">No. Badge</p>
                        <input
                            class="appearance-none block bg-gray-100 text-gray-700 border border-gray-300 rounded  px-4 h-12 w-full leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-300"
                            id="no_badge" name="no_badge" type="number" placeholder="25" required>
                    </div>
                </div>

                <div class="flex flex-row justify-between items-center gap-24">
                    <div class="flex flex-col gap-2 w-full">
                        <p class=" w-full">No. Surat</p>
                        <input
                            class="appearance-none block bg-gray-100 text-gray-700 border border-gray-300 rounded  px-4 h-12 w-full leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-300"
                            id="no_surat" name="no_surat" type="number" placeholder="123" required>
                    </div>
                    <div class="flex flex-col gap-2 w-full">
                        <p class=" w-full">No. Agenda</p>
                        <input
                            class="appearance-none block bg-gray-100 text-gray-700 border border-gray-300 rounded  px-4 h-12 w-full leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-300"
                            id="no_agenda" name="no_agenda" type="number" placeholder="123" required>
                    </div>
                </div>
                <div id="contJenisSimper" class="flex flex-row justify-between items-center gap-24">
                    <div class="flex flex-col gap-2 w-full">
                        <p class=" w-full">Jenis Simper</p>
                        <input
                            class="appearance-none block bg-gray-100 text-gray-700 border border-gray-300 rounded  px-4 h-12 w-full leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-300"
                            id="jenis_simper" name="jenis_simper" type="text" placeholder="Mobil">
                    </div>
                    <div class="flex flex-col gap-2 w-full">

                    </div>
                </div>
                <div class="flex flex-row justify-between gap-24 py-6">
                    <div class="flex flex-col gap-6 w-1/2">
                        <label class="block text-lg font-bold w-full text-blue-500">BERKAS</label>
                        <div class="flex flex-col gap-2 w-full">
                            <label for="file" class="block text-sm font-medium text-gray-600">Surat Permohonan </label>
                            <input type="file" name="surat_permohonan" id="surat_permohonan"
                                accept=".pdf, .jpg, .jpeg, .png"
                                class="  px-4 py-2 border border-gray-300 bg-gray-100 rounded-md w-full items-center" required>
                        </div>
                        <div class="flex flex-col gap-2 w-full">
                            <label for="file" class="block text-sm font-medium text-gray-600 w-full">Copy Simpol / SIO
                                Depnaker </label>
                            <input type="file" name="simpol" id="simpol" accept=".pdf, .jpg, .jpeg, .png"
                                class="  px-4 py-2 border border-gray-300 bg-gray-100 rounded-md w-full items-center" required>
                            <p class=" text-xs text-blue-400 font-bold"> SIMPER = SIMPOL | SIO = SIO DEPNAKER</p>
                        </div>
                        <div class=" hidden flex flex-col gap-2 w-full" id="divSimperLama">
                            <label for="file" class="block text-sm font-medium text-gray-600 w-full">Copy Simper / SIO
                                Lama </label>
                            <input type="file" name="simper_lama" id="simper_lama" accept=".pdf, .jpg, .jpeg, .png"
                                class="  px-4 py-2 border border-gray-300 bg-gray-100 rounded-md w-full items-center">
                            <p class=" text-xs text-blue-400 font-bold"> SIMPER = SIMPER LAMA | SIO = SIO LAMA</p>
                        </div>
                        <div class="flex flex-col gap-2 w-full">
                            <label for="file" class="block text-sm font-medium text-gray-600 w-full">Copy Badge
                            </label>
                            <input type="file" name="badge" id="badge" accept=".pdf, .jpg, .jpeg, .png"
                                class="  px-4 py-2 border border-gray-300 bg-gray-100 rounded-md w-full items-center" required>
                        </div>
                        <div class="flex flex-col gap-2 w-full">
                            <label for="file" class="block text-sm font-medium text-gray-600 w-full">Copy SPK </label>
                            <input type="file" name="spk" id="spk" accept=".pdf, .jpg, .jpeg, .png"
                                class="  px-4 py-2 border border-gray-300 bg-gray-100 rounded-md w-full items-center">
                        </div>
                    </div>
                    {{-- <div class="flex flex-col gap-6 w-1/2">
                        <label class="block text-lg font-bold w-full text-blue-500">KETERANGAN</label>
                        <div class="flex flex-row gap-4">
                            <label for="lengkap" class=" text-sm font-medium text-gray-600">Lengkap</label>
                            <input type="radio" name="keterangan" id="lengkap" value="Lengkap"
                                class=" px-4 py-2 border rounded-md w-6 h-6">
                        </div>
                        <div class="flex flex-row gap-4">
                            <label for="tidak_lengkap" class=" text-sm font-medium text-gray-600">Tidak
                                Lengkap</label>
                            <input type="radio" name="keterangan" id="tidak_lengkap" value="Tidak Lengkap"
                                class="px-4 py-2 border rounded-md w-6 h-6" checked>
                        </div>
                        <div class="flex flex-row gap-4">
                            <label for="kadaluarsa" class="text-sm font-medium text-gray-600">Kadaluarsa</label>
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
