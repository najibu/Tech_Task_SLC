<?php

namespace App\Http\Services\Book;

use App\Models\Book;

class Index
{
    /**
     * Get all books.
     */
    public function __invoke()
    {
        return Book::get();
    }
}
