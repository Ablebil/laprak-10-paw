<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mading Quotes</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#f4f4f0] m-0 font-sans text-black p-6 md:p-12">

    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-end border-b-4 border-black pb-4 mb-8">
            <h1 class="text-4xl md:text-5xl font-black uppercase m-0">Mading Quotes</h1>

            @auth
                <form action="/logout" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="bg-[#ff6b6b] hover:bg-[#fa5252] text-black font-bold border-[3px] border-black px-4 py-2 rounded shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all active:shadow-none active:translate-x-1 active:translate-y-1 cursor-pointer">
                        Logout
                    </button>
                </form>
            @else
                <a href="/login" class="bg-[#a9e34b] hover:bg-[#94d82d] text-black font-bold border-[3px] border-black px-4 py-2 rounded shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all active:shadow-none active:translate-x-1 active:translate-y-1">
                    Login Admin
                </a>
            @endauth
        </div>

        @auth
        <div class="bg-[#eebefa] border-4 border-black p-6 mb-10 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] rounded-lg">
            <h3 class="mt-0 mb-4 text-xl font-bold uppercase border-b-2 border-black pb-2 inline-block">Tambah Quote Baru</h3>
            <form action="/quotes" method="POST">
                @csrf
                <textarea name="quote_text" rows="3" placeholder="Tulis kutipan di sini..." required
                    class="w-full p-3 border-[3px] border-black rounded mb-4 focus:outline-none focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] focus:-translate-x-0.5 focus:-translate-y-0.5 transition-all text-base"></textarea>

                <input type="text" name="author" placeholder="Nama Penulis (Opsional)"
                    class="w-full p-3 border-[3px] border-black rounded mb-4 focus:outline-none focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] focus:-translate-x-0.5 focus:-translate-y-0.5 transition-all text-base">

                <button type="submit" class="bg-[#ffc900] hover:bg-[#e5b500] text-black font-black uppercase px-6 py-3 border-4 border-black rounded shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transition-all active:shadow-none active:translate-x-1.5 active:translate-y-1.5 cursor-pointer">
                    Simpan Quote
                </button>
            </form>
        </div>
        @endauth

        @foreach($quotes as $q)
        <div class="bg-white border-4 border-black p-6 mb-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] rounded-lg">
            <p class="text-2xl font-bold mb-2">"{{ $q->quote_text }}"</p>
            <p class="text-gray-600 italic mb-0">- {{ $q->author ?? 'Anonim' }}</p>

            @auth
            <div class="flex items-center gap-3 mt-6 pt-4 border-t-2 border-dashed border-gray-300">
                <a href="/quotes/{{ $q->id }}/edit" class="bg-[#4dabf7] hover:bg-[#339af0] text-black font-bold border-[3px] border-black px-4 py-2 rounded shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all active:shadow-none active:translate-x-1 active:translate-y-1">
                    Edit
                </a>
                <form action="/quotes/{{ $q->id }}" method="POST" class="m-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-[#ff6b6b] hover:bg-[#fa5252] text-black font-bold border-[3px] border-black px-4 py-2 rounded shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all active:shadow-none active:translate-x-1 active:translate-y-1 cursor-pointer">
                        Hapus
                    </button>
                </form>
            </div>
            @endauth
        </div>
        @endforeach

        @if($quotes->isEmpty())
            <div class="bg-white border-4 border-black p-8 text-center shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] rounded-lg">
                <p class="text-xl font-bold m-0">Belum ada quote nih. Masih kosong melompong.</p>
            </div>
        @endif
    </div>

</body>
</html>
