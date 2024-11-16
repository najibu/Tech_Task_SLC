<?php
namespace App\Http\Services\Book;

use App\Models\Book;

class Show
{
    /**
     * Get the specified book.
     */
    public function __invoke(Book $book): Book
    {
        return $book;
    }
}
