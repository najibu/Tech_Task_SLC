<?php
namespace App\Http\Services\Genre;

use App\Models\Genre;

class Show
{
    /**
     * Get the specified genre.
     * 
     * @param Genre $genre
     * @return Genre
     */
    public function __invoke(Genre $genre): Genre
    {
        return $genre;
    }
}
