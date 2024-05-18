@extends('layout')
@section('content')
    <div class="flex flex-col gap-6 p-6 ">
        <div class="flex flex-row gap-3 items-center">
            @role('user')
            <a href="/"><i class="fas fa-chevron-left text-blue-500 text-2xl"></i></a>
            @endrole
            @role('avp|vp')
            <a href="/users"><i class="fas fa-chevron-left text-blue-500 text-2xl"></i></a>
            @endrole
            <h1 class="text-2xl font-bold text-center">Detail User</h1>
            
        </div>
        @if(session()->has('success'))
            <p class="p-4 bg-green-500 rounded">{{session('success')}}</p>
        @endif
        <div class="flex flex-col p-6 gap-2 bg-white shadow-md">
            <div class="flex flex-row justify-between items-center gap-24">
                <div class="flex flex-col gap-2 w-full">
                    <p class=" w-full font-semibold">Nama</p>
                    <input
                        class="appearance-none block bg-gray-100 text-gray-700 border border-gray-300 rounded  px-4 h-12 w-full leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-300"
                        id="name" name="name" type="text" placeholder="Ronaldo" value="{{$user->name}}" disabled>
                </div>
                <div class="flex flex-col gap-2 w-full ">
                    <p class=" w-full font-semibold">instansi</p>
                    <input
                        class="appearance-none block bg-gray-100 text-gray-700 border border-gray-300 rounded  px-4 h-12 w-full leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-300"
                        id="instansi" name="instansi" type="text" placeholder="Ronaldo" value="{{$user->instansi}}" disabled>
                </div>
            </div>
            <div class="flex flex-row justify-between items-center gap-24">
                <div class="flex flex-col gap-2 w-full">
                    <p class=" w-full font-semibold">Email</p>
                    <input
                        class="appearance-none block bg-gray-100 text-gray-700 border border-gray-300 rounded  px-4 h-12 w-full leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-300"
                        id="email" name="email" type="text" placeholder="Ronaldo" value="{{$user->email}}" disabled>
                </div>
                <div class="flex flex-col gap-2 w-full ">
                    <p class=" w-full font-semibold">No Badge</p>
                    <input
                        class="appearance-none block bg-gray-100 text-gray-700 border border-gray-300 rounded  px-4 h-12 w-full leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-300"
                        id="no_badge" name="no_badge" type="number" placeholder="123" value="{{$user->no_badge}}" disabled>
                </div>
            </div>
            <div class="flex flex-row gap-2 self-end">
                @role('avp|vp')
                {{-- <a href="{{route('pengajuansimper.create')}}" class="px-4 py-2 text-white rounded bg-yellow-500 w-fit ">Reset Password</a> --}}
                @endrole
                <a href="/users/{{$user->id}}/edit" class="px-4 py-2 text-white rounded bg-orange-500 w-fit">EDIT</a>
                
            </div>
            
        </div>
    </div>
    @vite('resources/js/pengajuansimperIndex.js')
@endsection
