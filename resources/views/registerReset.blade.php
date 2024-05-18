<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body>
    <div class="flex flex-row justify-center w-full h-screen bg-gray-300">
        <div class="w-1/2 h-fit self-center bg-white rounded shadow-xl flex flex-col p-4 gap-4">
            @if (session()->has('Error'))
                <p>{{ session('Error') }}</p>
            @endif
            @if (session()->has('Success'))
                <p> {{ session('Success') }}</p>
            @endif
            @if (isset($user))
                <p>Silahkan buat password untuk akun anda</p>
                
                <form action="/register/reset/{{$user->id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-col gap-4 ">
                        <div class="flex flex-col gap-2 w-full">
                            <p class=" w-full">Email</p>
                            <input
                                class="appearance-none block bg-gray-100 text-gray-700 border border-gray-300 rounded  px-4 h-12 w-full leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-300"
                                id="email" name="email" type="text" value="{{$user->email}}" disabled required>
                            <input type="hidden" name="email" value="{{ $user->email }}">
                        </div>
                        <div class="flex flex-col gap-2 w-full">
                            <p class=" w-full">New Password</p>
                            <input
                                class="appearance-none block bg-gray-100 text-gray-700 border border-gray-300 rounded  px-4 h-12 w-full leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-300"
                                id="password" name="password" type="password" required>
                        </div>
                        <button
                        class="shadow-xl bg-orange-500 hover:bg-orange-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                        type="submit">
                        Ganti Password
                        </button>
                    </div>
                </form>
                
            @else
                <p> {{$pesan}}</p>
                <a href="/" class="text-blue-400 font-semibold underline">Login</a>
            @endif
            <p class="text-center text-gray-500 text-xs">PT PUPUK KALTIM , 2024.</p>
        </div>
    </div>
</body>

</html>
