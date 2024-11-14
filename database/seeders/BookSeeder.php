<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = Genre::all();

        Book::factory()
            ->count(5)
            ->create()
            ->each(function ($book) use ($genres) {
                $book->genres()->attach(
                    $genres->random(rand(1, 3))->pluck('id')->toArray()
                );
            });
    }
}
