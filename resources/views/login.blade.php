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
            <h1 class="self-center font-semibold text-lg italic"> PENGAJUAN SIMPER/SIO/STIKER</h1>
            @if (session()->has('loginError'))
                <p class=" text-red-500">{{ session('loginError') }}</p>
            @endif
            <form action="/login" method="POST">
                @csrf
                <div class=" flex flex-col gap-2 mb-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        E-Mail
                    </label>
                    <input
                        class=" bg-gray-100 border-gray-300 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline form-control"
                        id="email" name="email" type="text" placeholder="E-Mail" autofocus required>
                </div>
                <div class="flex flex-col gap-2 mb-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input
                        class="bg-gray-100 border-gray-300 appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline form-control"
                        id="password" name="password" type="password" placeholder="******************" required>
                </div>
                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Sign In
                    </button>
                </div>
            </form>
            <p> Belum mempunyai akun? <a href="/register" class="text-blue-400 font-semibold underline">Daftar</a></p>
            <p class="text-center text-gray-500 text-xs">
                PT PUPUK KALTIM , 2024.
        </div>
        


    </div>
</body>

</html>
