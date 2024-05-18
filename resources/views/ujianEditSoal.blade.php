@extends('layout')

@section('content')
    <div class="flex flex-col p-6 gap-4">
        <div class="flex flex-row gap-3">
            <a href="/ujian/{{$ujian->id}}"><i class="fas fa-chevron-left text-blue-500 text-2xl"></i></a>
            <h1 class="text-2xl font-bold text-center">Edit Soal & Jawaban ({{$ujian->nama}})</h1>
        </div>
        <form action="/ujian/{{$ujian->id}}/edit/{{$soal->id}}" method="post">
            @csrf
            @method('put')
            <div class="flex flex-col p-6 gap-2 bg-white shadow-md">
                <p class=" font-semibold text-lg">Pertanyaan:</p>
                <div class="border bg-gray-200 border-gray-300 shadow-md">
                    <textarea id="teks_soal" name="teks_soal" rows="4" placeholder="Isi Pertanyaan"  class="w-full h-full p-2 bg-gray-200"> {{$soal->teks}}</textarea>
                </div>
                <p class=" font-semibold text-lg">Jawaban:</p>
                <p class=" text-red-500 font-md font-semibold"> Checklist jawaban yang benar.</p>
                <div class="flex flex-col ">
                    <div class="my-2 p-2 w-full rounded" >
                        <div class="flex flex-row gap-3">
                            <input type="radio" id="radio_a" name="jawaban_benar" value="0" class=" " {{$jawabans[0]->value == 1 ? 'checked' :''}}>
                            <label for="radio_a" class=" self-center font-bold text-lg">A</label>
                            <textarea id="teks_jawaban_a" name="teks_jawaban_a" placeholder="Isi Jawaban" rows="2" " class="p-2 w-full border border-gray-300 bg-gray-200 ">{{$jawabans[0]->teks}}</textarea>
                        </div>
                    </div>
                    <div class="my-2 p-2 w-full rounded" >
                        <div class="flex flex-row gap-3">
                            <input type="radio" id="radio_b" name="jawaban_benar" value="1" class=" " {{$jawabans[1]->value == 1 ? 'checked' :''}}>
                            <label for="radio_b" class=" self-center font-bold text-lg">B</label>
                            <textarea id="teks_jawaban_b" name="teks_jawaban_b" placeholder="Isi Jawaban" rows="2" class="p-2 w-full border border-gray-300 bg-gray-200 ">{{$jawabans[1]->teks}}</textarea>
                        </div>
                    </div>
                    <div class="my-2 p-2 w-full rounded" >
                        <div class="flex flex-row gap-3">
                            <input type="radio" id="radio_c" name="jawaban_benar" value="2" class=" " {{$jawabans[2]->value == 1 ? 'checked' :''}}>
                            <label for="radio_c" class=" self-center font-bold text-lg">C</label>
                            <textarea id="teks_jawaban_c" name="teks_jawaban_c" placeholder="Isi Jawaban" rows="2" class="p-2 w-full border border-gray-300 bg-gray-200 ">{{$jawabans[2]->teks}}</textarea>
                        </div>
                    </div>
                    <div class="my-2 p-2 w-full rounded" >
                        <div class="flex flex-row gap-3">
                            <input type="radio" id="radio_d" name="jawaban_benar" value="3" class=" " {{$jawabans[3]->value == 1 ? 'checked' :''}}>
                            <label for="radio_d" class=" self-center font-bold text-lg">D</label>
                            <textarea id="teks_jawaban_d" name="teks_jawaban_d" placeholder="Isi Jawaban" rows="2" class="p-2 w-full border border-gray-300 bg-gray-200 ">{{$jawabans[3]->teks}}</textarea>
                        </div>
                    </div>
                    <div class="w-full flex flex-row-reverse gap-2">
                        <button type="submit" class="bg-blue-500 rounded text-white px-4 py-2">SUBMIT</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
