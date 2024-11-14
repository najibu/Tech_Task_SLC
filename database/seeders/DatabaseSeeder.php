<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::table('book_genre')->delete();
        DB::table('books')->delete();
        DB::table('genres')->delete();

        $this->call([
            GenreSeeder::class,
            BookSeeder::class,
        ]);

    }
}
