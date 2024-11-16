<?php
namespace App\Http\Services\Book;

use App\Models\Book;

class Show
{
    /**
     * Get the specified book.
     *
     * @param Book $book
     * @return Book
     */
    public function __invoke(Book $book): Book
    {
        return $book;
    }
}
