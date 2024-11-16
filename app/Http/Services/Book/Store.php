<?php

namespace App\Http\Services\Book;

use App\Models\Book;

class Store
{
    /**
     * Store a newly created book in storage.
     *
     * @param array $data
     * @return Book
     */
    public function __invoke(array $data): Book
    {
        $book = Book::create([
            'title' => $data['title'],
            'author' => $data['author'],
            'rating' => $data['rating']
        ]);

        if (array_key_exists('genres', $data) && count($data['genres']) > 0) {
            $book->genres()->attach($data['genres']);
        }

        return $book;
    }
}
