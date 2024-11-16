<?php

namespace App\Http\Services\Genre;

use App\Models\Genre;

class Destroy
{
    /**
     * Remove the specified genre from storage.
     * 
     * @param Genre $genre
     * @return void
     */
    public function __invoke(Genre $genre): void
    {
        $genre->delete();
    }
}
