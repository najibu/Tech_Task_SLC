<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Services\Book\Show;
use App\Http\Services\Book\Index;
use App\Http\Services\Book\Store;
use App\Http\Services\Book\Update;
use App\Http\Services\Book\Destroy;
use App\Http\Requests\Book\ShowRequest;
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

         return response()->json([
            'message' => 'Successfully stored the book.',
            'data' => $book->load('genres')
        ]);
    }

    /**
     * Display the specified book.
     *
     * @param  ShowRequest  $request
     * @param  Book  $book
     * @param  Show  $show
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function show(ShowRequest $request, Book $book, Show $show)
    {
        return response()->json([
            'message' => 'Successfully fetched the book.',
            'data' => $show($book)
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

        return response()->json([
            'message' => 'Successfully updated the book.',
            'data' => $updatedBook->load('genres')
        ]);
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
