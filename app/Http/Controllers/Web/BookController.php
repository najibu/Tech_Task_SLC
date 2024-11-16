<?php

namespace App\Http\Controllers\Web;

use App\Models\Book;
use App\Http\Controllers\Controller;
use App\Http\Requests\Book\Web\EditRequest;

class BookController extends Controller
{
    /**
     * Show the form for editing the specified book.
     *
     * @param  EditRequest  $request
     * @param  Book  $book
     * @return Illuminate\Contracts\View\View|Illuminate\Contracts\View\Factory
     */
    public function edit(EditRequest $request, Book $book)
    {
        return view('edit', compact('book'));
    }
}
