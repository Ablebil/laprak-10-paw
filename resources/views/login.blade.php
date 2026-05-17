<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Web Quotes</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#f4f4f0] flex justify-center items-center min-h-screen m-0 font-sans text-black px-4">
    <div class="bg-white border-4 border-black p-8 sm:p-10 w-full max-w-[420px] shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] rounded-lg">
        <h2 class="mt-0 text-3xl font-black uppercase border-b-4 border-black pb-4 mb-6">Login</h2>

        @if ($errors->any())
            <div class="bg-[#ff90e8] text-black font-bold border-[3px] border-black p-3 mb-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] rounded">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf
            <div class="mb-6">
                <label class="font-extrabold text-base block mb-2">Email:</label>
                <input type="email" name="email" required autocomplete="email" placeholder="admin@test.com"
                    class="w-full p-4 border-[3px] border-black rounded text-base transition-all duration-200 focus:outline-none focus:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] focus:-translate-x-0.5 focus:-translate-y-0.5">
            </div>

            <div class="mb-6">
                <label class="font-extrabold text-base block mb-2">Password:</label>
                <input type="password" name="password" required placeholder="••••••••"
                    class="w-full p-4 border-[3px] border-black rounded text-base transition-all duration-200 focus:outline-none focus:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] focus:-translate-x-0.5 focus:-translate-y-0.5">
            </div>

            <button type="submit"
                class="w-full bg-[#ffc900] hover:bg-[#e5b500] text-black text-lg font-black p-4 border-4 border-black rounded cursor-pointer shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] transition-all duration-100 uppercase active:shadow-none active:translate-x-2 active:translate-y-2">
                Login
            </button>
        </form>
    </div>
</body>
</html>
