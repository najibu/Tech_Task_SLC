<?php

namespace App\Http\Services\Genre;

use App\Models\Genre;

class Update
{
    /**
     * Update the specified genre in storage.
     *
     * @param  array  $data
     * @param  Genre  $genre
     * @return Genre
     */
    public function __invoke(array $data, Genre $genre): Genre
    {
        $genre->update([
            'name' => $data['name'] ?? $genre->name,
        ]);

        return $genre;
    }
}
