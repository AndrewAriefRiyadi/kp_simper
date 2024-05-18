@extends('layout')

@section('content')
    <div class="flex flex-col p-6 gap-4">
        <div class="flex flex-row items-center gap-3">
            <a href="{{ route('ujian.index') }}"><i
                    class="fas fa-chevron-left text-blue-500 text-2xl self-center"></i></a>
            <h1 class=" font-bold font-sans text-2xl ">Create Ujian</h1>
        </div>
        @if(session()->has('Error'))
            <p>{{session('Error')}}</p>
        @endif
        @if(session()->has('success'))
            <p>{{session('success')}}</p>
        @endif
        <form action="/ujian/create" method="post">
            @csrf
            <div class="flex flex-col gap-4">
                <div class="flex flex-col w-full">
                    <label for="nama" class="block font-medium bg-blue-500 text-white rounded-tr-full px-4 text-xl">Nama</label>
                    <input id="nama" name="nama" rows="4" placeholder="Ujian SIMPER" class="p-2 w-full border bg-gray-300"></input>
                </div>
                <div class="flex flex-col w-fit">
                    <label for="id_jenis_ujian" class="block font-medium bg-orange-500 text-white rounded-tr-full px-4 text-xl">Kategori</label>
                    <select id="id_jenis_ujian" name="id_jenis_ujian" class="px-6 py-4 font-bold  w-fit border bg-gray-300">
                        @foreach ($jenisUjians as $jenis)
                            <option value="{{$jenis->id}}">{{$jenis->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="px-4 py-4 my-8 bg-blue-500 text-white rounded-md w-fit">Create Ujian</button>
            </div>
        </form>
    </div>
@endsection
