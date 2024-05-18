@extends('layout')
@section('content')
    <div class="flex flex-col gap-6 p-6 ">
        <div class="flex flex-row gap-3">
            <a href="/ujian"><i class="fas fa-chevron-left text-blue-500 text-2xl"></i></a>
            <h1 class="text-2xl font-bold text-center">Ujian - {{ $ujian->nama }}</h1>
        </div>
        <a href="/ujian/{{$ujian->id}}/create" class="px-4 py-2 text-white rounded bg-blue-500 w-max">CREATE SOAL</a>
        @if(session()->has('success'))
            <p class="p-4 bg-green-500 rounded">{{session('success')}}</p>
        @endif
        @foreach ($soals as $key => $soal)
        <div class="flex flex-col p-6 gap-2 bg-white shadow-md">
            <p> {{$key + 1}}.</p>
            <p class=" font-semibold text-lg">Pertanyaan:</p>
            <div class=" p-4 border bg-gray-200 border-gray-300 shadow-md">
                <p class="">{{$soal->teks}}</p>
            </div>
            <p class=" font-semibold text-lg">Jawaban:</p>
            <div class="flex flex-col ">
                @foreach ($jawabans[$soal->id] as $jawaban)
                    <div class="{{ $jawaban->value == 1 ? 'bg-green-500' : '' }} my-2 p-2 w-fit rounded" >
                        <p>{{$jawaban->teks}}</p>
                    </div>
                @endforeach
                <div class="w-full flex flex-row-reverse gap-2">
                    <form action="{{ route('ujian.deleteSoal', ['id' => $soal->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 rounded text-white px-4 py-2">DELETE</button>
                    </form>
                    <form action="{{ route('ujian.editSoal', ['id1' => $ujian ->id , 'id2' => $soal->id ]) }}" method="get">
                        @csrf
                        <button type="submit" class="bg-yellow-500 rounded text-white px-4 py-2">EDIT</button>
                    </form>
                    
                </div>
            </div>
            
        </div>
        @endforeach
        {{ $soals->links() }}
    </div>
    @vite('resources/js/pengajuansimperIndex.js')
@endsection
