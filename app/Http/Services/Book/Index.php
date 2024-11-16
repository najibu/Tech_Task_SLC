<?php

namespace App\Http\Services\Book;

use App\Models\Book;

class Index
{
    /**
     * Get all books.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function __invoke()
    {
        return Book::get();
    }
}
