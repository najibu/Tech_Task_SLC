<?php

namespace App\Http\Services\Genre;

use App\Models\Genre;

class Store
{
    /**
     * Store a newly created genre in storage.
     */
    public function __invoke(array $data): Genre
    {
        return Genre::create([
            'name' => $data['name'],
        ]);
    }
}
