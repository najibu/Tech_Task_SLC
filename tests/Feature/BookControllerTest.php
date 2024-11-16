<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

   /**
     * Test updating a book with valid data.
     */
    public function testUpdateBookWithValidData()
    {
        $book = Book::factory()->create();
        $genres = Genre::factory()->count(3)->create();

        $data = [
            'title' => 'Updated Title',
            'author' => 'Updated Author',
            'rating' => 5,
            'genres' => $genres->pluck('id')->toArray()
        ];

        $response = $this->putJson(route('books.update', $book), $data);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Successfully updated the book.',
                'data' => [
                    'id' => $book->id,
                    'title' => $data['title'],
                    'author' => $data['author'],
                    'rating' => $data['rating'],
                    'created_at' => $book->created_at->toISOString(),
                    'updated_at' => $book->fresh()->updated_at->toISOString(),
                    'deleted_at' => null,
                    'genres' => $book->genres->toArray()
                ]
            ]);

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => $data['title'],
            'author' => $data['author'],
            'rating' => $data['rating']
        ]);

        $this->assertDatabaseHas('book_genre', [
            'book_id' => $book->id,
            'genre_id' => $genres->first()->id
        ]);

    }

    /**
     * Test updating a book with invalid data.
     */
    public function testUpdateBookWithInvalidData()
    {
       $book = Book::factory()->create();

        $data = [
            'title' => 1,
            'author' => 2,
            'rating' => 11
        ];

        $response = $this->putJson(route('books.update', $book), $data);
        
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['title', 'author', 'rating']);

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => $book->title,
            'author' => $book->author,
            'rating' => $book->rating
        ]);
    }

    /**
     * Test updating a book without genres.
     */
    public function testUpdateBookWithoutGenres()
    {
        $book = Book::factory()->create();

        $data = [
            'title' => 'Updated Title',
            'author' => 'Updated Author',
            'rating' => 5
        ];

        $response = $this->putJson(route('books.update', $book), $data);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Successfully updated the book.',
                'data' => [
                    'id' => $book->id,
                    'title' => $data['title'],
                    'author' => $data['author'],
                    'rating' => $data['rating'],
                    'created_at' => $book->created_at->toISOString(),
                    'updated_at' => $book->fresh()->updated_at->toISOString(),
                    'deleted_at' => null,
                    'genres' => []
                ]
            ]);

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => $data['title'],
            'author' => $data['author'],
            'rating' => $data['rating']
        ]);
    }
}
