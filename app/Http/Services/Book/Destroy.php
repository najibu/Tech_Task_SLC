<?php

namespace App\Http\Services\Book;

use App\Models\Book;

class Destroy
{
    /**
     * Remove the specified book from storage.
     */
    public function __invoke(Book $book): void
    {
        $book->delete();
    }
}
