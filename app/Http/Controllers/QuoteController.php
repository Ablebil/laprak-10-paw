<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        $quotes = Quote::latest()->get();
        return view("quotes.index", compact("quotes"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "quote_text" => "required",
            "author" => "nullable",
        ]);

        Quote::create($request->all());
        return redirect("/quotes");
    }

    public function edit(Quote $quote)
    {
        return view("quotes.edit", compact("quote"));
    }

    public function update(Request $request, Quote $quote)
    {
        $request->validate([
            "quote_text" => "required",
            "author" => "nullable",
        ]);

        $quote->update($request->all());
        return redirect("/quotes");
    }

    public function destroy(Quote $quote)
    {
        $quote->delete();
        return redirect("/quotes");
    }
}
