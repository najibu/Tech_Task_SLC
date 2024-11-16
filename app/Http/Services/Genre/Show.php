<?php
namespace App\Http\Services\Genre;

use App\Models\Genre;

class Show
{
    /**
     * Get the specified genre.
     */
    public function __invoke(Genre $genre): Genre
    {
        return $genre;
    }
}
