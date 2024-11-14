<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            ['name' => 'Science Fiction'],
            ['name' => 'Fantasy'],
            ['name' => 'Mystery'],
            ['name' => 'Thriller'],
            ['name' => 'Romance'],
            ['name' => 'Horror'],
            ['name' => 'Non-Fiction'],
            ['name' => 'Historical Fiction'],
            ['name' => 'Young Adult'],
            ['name' => 'Children'],
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }
}
