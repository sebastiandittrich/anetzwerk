<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quote;

class QuotesController extends Controller
{
    public function all()
    {
        $quotes = Quote::orderBy('updated_at', 'desc')->get();
        return view('quote.all', compact('quotes'));
    }

    public function create()
    {
        return view('quote.create');
    }

    public function store()
    {
        $this->validate(request(), [
            'quote' => 'required|string',
            'fake_author' => 'required|string|max:255',
            'real_author' => 'required|string|max:255'
        ]);

        $quote = Quote::create([
            'user_id' => auth()->id(),
            'content' => request('quote'),
            'fake_author' => request('fake_author'),
            'real_author' => request('real_author')
        ]);

        return redirect('/quotes');
    }
}
