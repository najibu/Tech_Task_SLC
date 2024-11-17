<?php

namespace App\Http\Services\Book;

use App\Models\Book;

class Index
{
    /**
     * Get all books.
     *
     * @param string|null $query
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function __invoke(?string $query = null)
    {
        if ($query) {
            return Book::search($query)->get();
        }

        return Book::get();
    }
}
