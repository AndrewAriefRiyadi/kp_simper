@extends('layout')
@section('content')
    <div class="h-screen  p-6">
        <p class=" font-sans font-semibold text-lg">Halo, {{$user->name}} </p>
        @role('admin')
            Anda adalah admin
        @else
            Silahkan pilih menu
        @endrole
        @if (isset($exception))
            <p class=" p-4 bg-red-500 rounded text-white "> {{$exception}}</p>
            
        @endif
    </div>
    
@endsection
