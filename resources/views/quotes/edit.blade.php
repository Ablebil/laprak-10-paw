<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Quote</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#f4f4f0] m-0 font-sans text-black p-6 md:p-12 flex justify-center min-h-screen">

    <div class="bg-white border-4 border-black p-8 max-w-2xl w-full h-fit shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] rounded-lg">
        <h2 class="text-3xl font-black uppercase border-b-4 border-black pb-4 mb-6 mt-0">Edit Quote</h2>

        <form action="/quotes/{{ $quote->id }}" method="POST">
            @csrf
            @method('PUT')

            <label class="block font-bold mb-2">Isi Quote:</label>
            <textarea name="quote_text" rows="4" required
                class="w-full p-3 border-[3px] border-black rounded mb-4 focus:outline-none focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] focus:-translate-x-0.5 focus:-translate-y-0.5 transition-all text-base">{{ $quote->quote_text }}</textarea>

            <label class="block font-bold mb-2">Penulis:</label>
            <input type="text" name="author" value="{{ $quote->author }}"
                class="w-full p-3 border-[3px] border-black rounded mb-6 focus:outline-none focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] focus:-translate-x-0.5 focus:-translate-y-0.5 transition-all text-base">

            <div class="flex gap-4">
                <button type="submit" class="bg-[#4dabf7] hover:bg-[#339af0] text-black font-black uppercase px-6 py-3 border-4 border-black rounded shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transition-all active:shadow-none active:translate-x-1.5 active:translate-y-1.5 cursor-pointer">
                    Update Data
                </button>
                <a href="/quotes" class="bg-[#ff90e8] hover:bg-[#f065d6] text-black font-black uppercase px-6 py-3 border-4 border-black rounded shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transition-all active:shadow-none active:translate-x-1.5 active:translate-y-1.5 text-center flex items-center">
                    Batal
                </a>
            </div>
        </form>
    </div>

</body>
</html>
