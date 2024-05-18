@extends('layout')
@section('content')


    <div class="flex flex-col gap-2 font-sans ">
        <div class="flex flex-row justify-between  p-6">
            <div class="flex flex-row gap-3">
                <a href="{{ route('pengajuansimper.index') }}"><i
                        class="fas fa-chevron-left text-blue-500 text-2xl self-center"></i></a>
                <h1 class=" font-bold font-sans text-2xl ">Detail {{ $jenis_pengajuan->nama }} {{$pengajuanSimper->perihal}} </h1>
            </div>
        </div>
        @if (session()->has('Error'))
            <p class="p-6 mx-6  bg-red-500 rounded w-fit">{{ session('Error') }}</p>
        @endif
        @if (session()->has('success'))
            <p class="p-6 mx-6 bg-green-500 rounded w-fit">{{ session('success') }}</p>
        @endif
        @if (isset($pusim))
            @if ($pusim->nilai >= 70)
                @if ($pengajuanSimper->id_pembayaran == null)
                    @if ($pengajuanSimper->status_vp == 1)
                        <div class=" bg-green-400 flex flex-col gap-4 m-6 p-4 rounded">
                            <h1 class=" font-bold text-2xl ">Selamat Anda Lulus</h1>
                            <p class=" font-bold text-md "> Anda telah melakukan ujian dan mendapatkan nilai {{ $pusim->nilai }}</p>
                            <p class=" font-bold text-md "> Silahkan menuju halaman pembayaran, untuk melakukan pembayaran.</p>
                            <a href="/pengajuansimper/{{ $pengajuanSimper->id }}/pembayaran"
                                class="px-4 py-2 text-white rounded bg-blue-500 w-min">Pembayaran</a>
                            @role('vp|avp')
                            <a href="/pengajuansimper/{{ $pengajuanSimper->id }}/ujian/result"
                                class="px-4 py-2 text-white rounded bg-blue-500 w-fit">Review Ujian</a>
                            @endrole
                        </div>
                    @endif
                    @if ($pengajuanSimper->status_vp == 3)
                        <div class=" bg-red-400 flex flex-col gap-4 m-6 p-4 rounded">
                            <h1 class=" font-bold text-2xl ">Hasil Ujian Anda DITOLAK</h1>
                            @role('vp|avp')
                                <a href="/pengajuansimper/{{ $pengajuanSimper->id }}/ujian/result"
                                    class="px-4 py-2 text-white rounded bg-blue-500 w-fit">Review Ujian</a>
                            @endrole
                        </div>
                    @endif
                    @if ($pengajuanSimper->status_vp != 1 and $pengajuanSimper->status_vp != 3)
                        <div class=" bg-gray-400 flex flex-col gap-4 m-6 p-4 rounded">
                            <h1 class=" font-bold text-2xl ">Harap Tunggu hasil</h1>
                            @role('vp|avp')
                                <a href="/pengajuansimper/{{ $pengajuanSimper->id }}/ujian/result"
                                    class="px-4 py-2 text-white rounded bg-blue-500 w-fit">Review Ujian</a>
                            @endrole
                        </div>
                    @endif
                @else
                    <div class=" bg-green-400 flex flex-col gap-4 m-6 p-4 rounded">
                        <h1 class=" font-bold text-2xl ">PEMBAYARAN BERHASIL</h1>
                        <p class=" font-bold text-md "> Anda telah melakukan pembayaran, berikut merupakan bukti pembayaran
                        </p>
                        <a href="#"
                            class="p-2 bg-blue-400 w-fit rounded"
                            onclick="openModal('{{ str_replace('berkas/', '', $pembayaran->bukti) }}')">
                            Bukti
                        </a>
                    </div>
                @endif
                
            @else
                <div class=" bg-red-400 flex flex-col gap-4 m-6 p-4 rounded">
                    <h1 class=" font-bold text-2xl ">Anda tidak lulus</h1>
                    <p class=" font-bold text-md "> Anda telah melakukan ujian dan mendapatkan nilai {{ $pusim->nilai }}</p>
                    @role('vp|avp')
                    <a href="/pengajuansimper/{{ $pengajuanSimper->id }}/ujian/result"
                        class="px-4 py-2 text-white rounded bg-blue-500 w-fit">Review Ujian</a>
                    @endrole
                </div>
            @endif
        @else
            @if ($pengajuanSimper->status_avp == 1)
                <div class=" bg-yellow-400 flex flex-col gap-4 m-6 p-4 rounded">
                    <h1 class=" font-bold text-2xl ">UJIAN</h1>
                    <p class=" font-bold text-md "> Berkas anda lolos validasi. Selesaikan Ujian untuk mendapatkan SIMPER
                    </p>
                    <a href="/pengajuansimper/{{ $pengajuanSimper->id }}/ujian/prepare"
                        class="px-4 py-2 text-white rounded bg-blue-500 w-min">UJIAN</a>
                </div>
            @endif
            @if ($pengajuanSimper->status_avp == 2)
                <div class=" bg-yellow-400 flex flex-col gap-4 m-6 p-4 rounded no-tailwindcss-base">
                    <h1 class=" font-bold text-2xl ">Revisi</h1>
                    @if ($pengajuanSimper->keterangan_revisi == null)
                        <p class=" font-bold text-md "> Berkas anda perlu direvisi.
                        </p>
                    @else
                        {!! $pengajuanSimper->keterangan_revisi !!}
                    @endif
                    <a href="/pengajuansimper/{{$pengajuanSimper->id}}/edit"
                        class="p-2 bg-blue-400 w-fit rounded">
                        Revisi
                    </a>
                </div>
            @endif
            @if ($pengajuanSimper->status_avp == 3)
                <div class=" bg-red-400 flex flex-col gap-4 m-6 p-4 rounded no-tailwindcss-base">
                    <h1 class=" font-bold text-2xl ">Berkas Anda DITOLAK</h1>
                </div>
            @endif
        @endif
        <div class="flex flex-row bg-gray-100 shadow-lg m-6 p-4 gap-4 rounded w-fit">
            <div class="flex flex-col gap-2">
                <h1 class=" font-bold font-sans text-2xl">Biodata</h1>
                <div class="bg-gray-300 w-fit rounded py-4 rounded-tr-3xl">
                    <div class="flex flex-row gap-6">
                        <div class="flex flex-col px-6 gap-3 text-gray-700">
                            <p>Nama</p>
                            <p>Diterima Tanggal</p>
                            <p>Dari</p>
                            <p>No Surat</p>
                            <p>No Agenda</p>
                            <p>No Badge</p>
                        </div>
                        <div class="flex flex-col px-6 gap-3 font-bold">
                            <p>{{ $pengajuanSimper->nama }}</p>
                            <p>{{ $pengajuanSimper->diterima_tgl }}</p>
                            <p>{{ $pengajuanSimper->dari }}</p>
                            <p>{{ $pengajuanSimper->no_surat }}</p>
                            <p>{{ $pengajuanSimper->no_agenda }}</p>
                            <p>{{ $pengajuanSimper->no_badge }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <h1 class=" font-bold font-sans text-2xl">Perihal</h1>
                <div class="bg-gray-300 w-fit rounded py-4 rounded-tr-3xl h-full">
                    <div class=" flex flex-col px-6 gap-2 font-bold">
                        <p>{{ $jenis_pengajuan->nama }} {{$pengajuanSimper->perihal}}.</p>
                        @if ($pengajuanSimper->perihal == "SIMPER") 
                        <p> Jenis : {{ $pengajuanSimper->jenis_simper }}</p> 
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="flex flex-col gap-2">
                <h1 class=" font-bold font-sans text-2xl">Status</h1>
                <div class="bg-gray-300 w-fit rounded py-4 rounded-tr-3xl h-full">
                    <div class=" flex flex-row px-6 gap-6">
                        <div class="flex flex-col gap-4">
                            <p>Status AVP:</p>
                            <p>Status VP:</p>
                            <p>Keterangan:</p>
                        </div>
                        <div class="flex flex-col gap-4 text-center">
                            <p id="avpContainer"></p>
                            <p id="vpContainer"></p>
                            <p>{{$pengajuanSimper->keterangan}}</p>
                            <p class="text-blue-400 underline"><a href="/users/{{$pengajuanSimper->id_user}}">Yang Mengajukan</a></p>
                        </div>
                    </div>
                </div>
            </div>
            @role ('vp|avp')
            <div class="flex flex-col gap-2">
                <h1 class=" font-bold font-sans text-2xl">Ujian</h1>
                <div class="flex flex-col gap-2">
                    <div class="flex flex-row w-full">
                            @if ($ujians)
                                <a href="/ujian/{{ $ujians->id }}"
                                    class="pl-2 pr-12 pt-2 pb-24 text-xl font-bold text-white rounded rounded-tr-3xl h-full bg-orange-500 w-min hover:bg-orange-800">{{ $ujians->nama }}</a>
                            @endif
                    </div>
                </div>
            </div>
            @endrole
        </div>
        <div class=" bg-gray-100 shadow-lg flex flex-col m-6 p-4 gap-4 rounded">
            <h1 class=" font-bold font-sans text-2xl">Berkas</h1>
            <table class="table-auto rounded-md overflow-hidden w-full">
                <thead class=" bg-orange-500 text-left font-sans font-bold text-md">
                    <tr class=" text-white">
                        <th class="py-4 px-4 border-b">Dokumen</th>
                        <th class="py-4 px-4 border-b">File</th>
                        <th class="py-4 px-4 border-b">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class=" bg-orange-100 hover:bg-orange-50 ">
                        <td class="py-4 px-4 border-b">Surat Permohonan</td>
                        @if ($pengajuanSimper->surat_permohonan)
                            <td class="py-4 px-4 border-b">
                                <i class="fas fa-file text-red-500 text-2xl"></i>
                                <a href="#"
                                    onclick="openModal('{{ str_replace('berkas/', '', $pengajuanSimper->surat_permohonan) }}')">
                                    Surat Permohonan
                                </a>
                            </td>
                            <td class="py-4 px-4 border-b"><i class="fas fa-check-square text-green-700"></i></td>
                        @else
                            <td class="py-4 px-4 border-b">-</td>
                            <td class="py-4 px-4 border-b"><i class="fas fa-window-close text-red-700"></i></td>
                        @endif

                    </tr>
                    <tr class="bg-orange-100 hover:bg-orange-50 ">
                        <td class="py-4 px-4 border-b">SIMPOL / SIO Depnaker</td>
                        @if ($pengajuanSimper->simpol)
                            <td class="py-4 px-4 border-b">
                                <i class="fas fa-file text-red-500 text-2xl"></i>
                                <a href="#"
                                    onclick="openModal('{{ str_replace('berkas/', '', $pengajuanSimper->simpol) }}')">
                                    @if ($pengajuanSimper->perihal == "SIMPER") 
                                    SIMPOL
                                    @endif
                                    @if ($pengajuanSimper->perihal == "SIO") 
                                    SIO Depnaker
                                    @endif
                                </a>
                            </td>
                            <td class="py-4 px-4 border-b"><i class="fas fa-check-square text-green-700"></i></td>
                        @else
                            <td class="py-4 px-4 border-b">-</td>
                            <td class="py-4 px-4 border-b"><i class="fas fa-window-close text-red-700"></i></td>
                        @endif
                    </tr>
                    @if ($jenis_pengajuan->nama == 'Pembaruan')
                        <tr class="bg-orange-100 hover:bg-orange-50 ">
                            <td class="py-4 px-4 border-b">SIMPER / SIO LAMA</td>
                            @if ($pengajuanSimper->simper_lama)
                                <td class="py-4 px-4 border-b">
                                    <i class="fas fa-file text-red-500 text-2xl"></i>
                                    <a href="#"
                                        onclick="openModal('{{ str_replace('berkas/', '', $pengajuanSimper->simper_lama) }}')">
                                        @if ($pengajuanSimper->perihal == "SIMPER") 
                                        SIMPER Lama
                                        @endif
                                        @if ($pengajuanSimper->perihal == "SIO") 
                                        SIO Lama
                                        @endif
                                        
                                    </a>
                                </td>
                                <td class="py-4 px-4 border-b"><i class="fas fa-check-square text-green-700"></i></td>
                            @else
                                <td class="py-4 px-4 border-b">-</td>
                                <td class="py-4 px-4 border-b"><i class="fas fa-window-close text-red-700"></i></td>
                            @endif
                        </tr>
                    @endif
                    <tr class="bg-orange-100 hover:bg-orange-50 ">
                        <td class="py-4 px-4 border-b">Badge</td>
                        @if ($pengajuanSimper->badge)
                            <td class="py-4 px-4 border-b">
                                <i class="fas fa-file text-red-500 text-2xl"></i>
                                <a href="#"
                                    onclick="openModal('{{ str_replace('berkas/', '', $pengajuanSimper->badge) }}')">
                                    Badge
                                </a>
                            </td>
                            <td class="py-4 px-4 border-b"><i class="fas fa-check-square text-green-700"></i></td>
                        @else
                            <td class="py-4 px-4 border-b">-</td>
                            <td class="py-4 px-4 border-b"><i class="fas fa-window-close text-red-700"></i></td>
                        @endif
                    </tr>
                    <tr class="bg-orange-100 hover:bg-orange-50 ">
                        <td class="py-4 px-4 border-b">SPK</td>
                        @if ($pengajuanSimper->spk)
                            <td class="py-4 px-4 border-b">
                                <i class="fas fa-file text-red-500 text-2xl"></i>
                                <a href="#"
                                    onclick="openModal('{{ str_replace('berkas/', '', $pengajuanSimper->spk) }}')">
                                    SPK
                                </a>
                            </td>
                            <td class="py-4 px-4 border-b"><i class="fas fa-check-square text-green-700"></i></td>
                        @else
                            <td class="py-4 px-4 border-b">-</td>
                            <td class="py-4 px-4 border-b"><i class="fas fa-window-close text-red-700"></i></td>
                        @endif
                    </tr>
                    
                </tbody>
            </table>
        </div>
        
        <form action="{{ route('pengajuansimper.changeStatusAvp', ['id' => $pengajuanSimper->id]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="flex flex-row justify-end px-6 gap-4">
                @can('change to reject')
                <button type="submit" name="status_avp" value="3"
                    class="mt-2 bg-red-500 text-black px-4 py-2 rounded-md">Reject</button>
                @endcan
                @can('change to revise')
                <button id="btnRevisi" type="button"
                    class="mt-2 bg-yellow-500 text-black px-4 py-2 rounded-md">Revise</button>
                @endcan
                @can('change to approve')
                <button type="submit" name="status_avp" value="1"
                    class="mt-2 bg-green-500 text-black px-4 py-2 rounded-md">Approve</button>
                @endcan
            </div>
        </form>
    </div>

    <div id="revisiModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex flex-col justify-center z-50 p-56">
        <div class="p-8 bg-gray-300 shadow-lg border-gray-300 rounded flex flex-col no-tailwindcss-base gap-2">
            <p class=" font-semibold  text-xl">Keterangan Revisi</p>
            <form action="{{ route('pengajuansimper.changeStatusAvp', ['id' => $pengajuanSimper->id]) }}" method="post">
                @csrf
                @method('PUT')
                <textarea name="keterangan_revisi" role="list" id="editor">
                    @if ($pengajuanSimper->keterangan_revisi != null)
                    {{ $pengajuanSimper->keterangan_revisi }}
                    @endif
                </textarea>
                <label class="block text-lg font-bold w-full text-blue-500">Keterangan Berkas</label>
                <div class="flex flex-col gap-2 w-1/4 ">
                    <div class="flex flex-row gap-4 justify-between">
                        <label for="lengkap" class=" text-sm font-medium text-gray-600">Lengkap</label>
                        <input type="radio" name="keterangan" id="lengkap" value="Lengkap"
                            class=" px-4 py-2 border rounded-md w-6 h-6">
                    </div>
                    <div class="flex flex-row gap-4 justify-between">
                        <label for="tidak_lengkap" class=" text-sm font-medium text-gray-600">Tidak
                            Lengkap</label>
                        <input type="radio" name="keterangan" id="tidak_lengkap" value="Tidak Lengkap"
                            class="px-4 py-2 border rounded-md w-6 h-6" checked>
                    </div>
                    <div class="flex flex-row gap-4 justify-between">
                        <label for="kadaluarsa" class="text-sm font-medium text-gray-600">Kadaluarsa</label>
                        <input type="radio" name="keterangan" id="kadaluarsa" value="Lengkap"
                            class="px-4 py-2 border rounded-md w-6 h-6">
                    </div>
                </div>
                
                <div class="flex flex-row-reverse gap-4">
                    <button id="btnRevisi" type="submit" value="2" name="status_avp"
                        class="mt-2 bg-orange-400  px-4 py-2 rounded-md items-end text-white">Ajukan Revisi</button>
                    <button id="btnKeluarRevisi" type="button"
                        class="mt-2 bg-red-400  px-4 py-2 rounded-md items-end text-white">Keluar</button>
                </div>
            </form>
        </div>
    </div>

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
        ClassicEditor
            .create(document.querySelector('#editor'), {
                placeholder: "Silahkan isi keterangan revisi disini.."
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        document.getElementById("btnRevisi").addEventListener("click", function() {
            myFunction();
        });

        document.getElementById("btnKeluarRevisi").addEventListener("click", function() {
            myFunction1();
        });

        function myFunction() {
            console.log("function");
            document.getElementById('revisiModal').classList.remove("hidden");
        }

        function myFunction1() {
            console.log("function");
            document.getElementById('revisiModal').classList.add("hidden");
        }
    </script>
    <script>
        // Fungsi untuk mengambil dan menampilkan data dari API
        function fetchDataAndDisplay(url, containerId) {
            fetch(url)
                .then(response => response.text())
                .then(data => {
                    const dataContainer = document.getElementById(containerId);

                    // Menentukan kelas CSS berdasarkan nilai data
                    let cssClass = 'font-bold px-2 rounded';
                    if (data.toLowerCase() === 'approved') {
                        cssClass = cssClass + ' bg-green-500';
                    } else if (data.toLowerCase() === 'revise') {
                        cssClass = cssClass + ' bg-yellow-500';
                    } else if (data.toLowerCase() === 'reject') {
                        cssClass = cssClass + ' bg-red-500';
                    } else if (data.toLowerCase() === 'review') {
                        cssClass = cssClass + ' bg-gray-400';
                    }

                    // Menetapkan kelas ke dalam elemen kontainer
                    dataContainer.className = cssClass;
                    // Menampilkan data di dalam elemen HTML
                    dataContainer.innerHTML = data;
                })
                .catch(error => {
                    console.error("Error:", error);
                });
        }

        // URL API yang akan diambil datanya
        const avpUrl = `/api/vl_status/{{ $pengajuanSimper->status_avp }}`;
        const vpUrl = `/api/vl_status/{{ $pengajuanSimper->status_vp }}`;

        // Menggunakan fungsi untuk mengambil dan menampilkan data
        fetchDataAndDisplay(avpUrl, "avpContainer");
        fetchDataAndDisplay(vpUrl, "vpContainer");
    </script>
    <script>
        function openModal(filename) {
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
@endsection
