@extends('layout')
@section('content')
    <div class="flex flex-col gap-4 p-6 font-bold font-sans ">
        @if (session()->has('Error'))
            <p>{{ session('Error') }}</p>
        @endif
        <div class="flex flex-row items-center gap-3">
            <a href="/pengajuansimper/{{ $psimper->id }}"><i
                    class="fas fa-chevron-left text-blue-500 text-2xl self-center"></i></a>
            <h1 class=" font-bold font-sans text-2xl ">Pembayaran</h1>
        </div>
        
        <h1 class=" text-lg">Nominal: Rp 300.000</h1>
        <form class="flex flex-col gap-4" action="/pengajuansimper/{{$psimper->id}}/pembayaran" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="nominal" value="150000">
            <div class="flex flex-row gap-4 items-center">
                <h1 class=" text-lg">Pilih Metode</h1>
                <select name="metode" id="metodeSelect" class="py-2 px-2 bg-white shadow-md rounded w-fit">
                    <option value="transfer">Transfer Bank</option>
                    <option value="qris">Qris</option>
                </select>
            </div>
            <div class="bg-white shadow-lg border-gray-300 p-4 flex flex-col gap-4">
                <div id="penjelasanTransfer" class="">
                    <h1>Penjelasan Metode Transfer Bank</h1>
                    <p> Jenis Bank dan Rekening yang tersedia adalah sebagai berikut;</p>
                </div>
                <div id="penjelasanQris" class="hidden">
                    <h1>Penjelasan Metode Qris</h1>
                    <!-- Tambahkan penjelasan untuk Qris di sini -->
                </div>
                <div class="flex flex-col gap-2 w-1/2" id="contPembayaran">
                    <label for="file" class="block text-sm font-semibold w-full">Upload Bukti Pembayaran</label>
                    <input type="file" name="bukti" id="bukti" accept=".pdf, .jpg, .jpeg, .png"
                        class="  px-4 py-2 border border-gray-300 bg-gray-100 rounded-md w-full items-center" required>
                </div>
                <button
                    class=" w-fit shadow-xl bg-orange-500 hover:bg-orange-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                    type="submit">
                    Bayar
                </button>
            </div>
            
        </form>
    </div>
    <script>
        document.getElementById('metodeSelect').addEventListener('change', function() {
            // Mendapatkan nilai terpilih dari dropdown
            var selectedValue = this.value;

            // Menyembunyikan semua elemen penjelasan
            document.getElementById('penjelasanTransfer').classList.add('hidden');
            document.getElementById('penjelasanQris').classList.add('hidden');

            // Menampilkan elemen penjelasan yang sesuai dengan pilihan
            if (selectedValue === 'transfer') {
                document.getElementById('penjelasanTransfer').classList.remove('hidden');
            } else if (selectedValue === 'qris') {
                document.getElementById('penjelasanQris').classList.remove('hidden');
            }
        });
    </script>
@endsection
