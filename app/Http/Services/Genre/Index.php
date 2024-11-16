<?php

namespace App\Http\Services\Genre;

use App\Models\Genre;

class Index
{
    /**
     * Get all genres.
     */
    public function __invoke()
    {
        return Genre::get();
    }
}
