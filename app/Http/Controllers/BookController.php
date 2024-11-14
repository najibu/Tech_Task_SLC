<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Response;
use App\Http\Services\Book\Index;
use App\Http\Services\Book\Store;
use App\Http\Services\Book\Update;
use App\Http\Services\Book\Destroy;
use App\Http\Requests\Book\EditRequest;
use App\Http\Requests\Book\IndexRequest;
use App\Http\Requests\Book\StoreRequest;
use App\Http\Requests\Book\UpdateRequest;
use App\Http\Requests\Book\DestroyRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the books.
     *
     * @param  IndexRequest  $request
     * @param  Index  $index
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function index(IndexRequest $request, Index $index)
    {
        return response()->json([
            'message' => 'Successfully fetched the books.',
            'data' => $index()
        ]);
    }

    /**
     * Store a newly created book in storage.
     *
     * @param  StoreRequest  $request
     * @param  Store  $store
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function store(StoreRequest $request, Store $store)
    {
        $book = $store($request->validated());

        if ($request->has('genres')) {
            $book->genres()->attach($request->genres);
        }

         return response()->json([
            'message' => 'Successfully stored the book.',
            'data' => $book
        ]);
    }

    /**
     * Update the specified book in storage.
     *
     * @param  UpdateRequest  $request
     * @param  Update  $update
     * @param  Book  $book
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function update(UpdateRequest $request, Update $update, Book $book)
    {
        $updatedBook = $update($request->validated(), $book);

        if ($request->has('genres')) {
            $updatedBook->genres()->sync($request->genres);
        }

        return response()->json([
            'message' => 'Successfully updated the book.',
            'data' => $updatedBook
        ]);
    }

    /**
     * Show the form for editing the specified book.
     *
     * @param  EditRequest  $request
     * @param  Book  $book
     * @return Illuminate\Contracts\View\View|Illuminate\Contracts\View\Factory
     */
    public function edit(EditRequest $request, Book $book)
    {
        return view('edit', compact('book'));
    }

    /**
     * Remove the specified book from storage.
     *
     * @param  DestroyRequest  $request
     * @param  Destroy  $destroy
     * @param  Book  $book
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function destroy(DestroyRequest $request, Destroy $destroy, Book $book)
    {
        $destroy($book);

        return response()->json([
            'message' => 'Successfully deleted the book.',
        ]);
    }
}
