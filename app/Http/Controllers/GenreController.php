<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use App\Http\Services\Genre\Show;
use App\Http\Services\Genre\Index;
use App\Http\Services\Genre\Store;
use App\Http\Services\Genre\Update;
use App\Http\Services\Genre\Destroy;
use App\Http\Requests\Genre\ShowRequest;
use App\Http\Requests\Genre\IndexRequest;
use App\Http\Requests\Genre\StoreRequest;
use App\Http\Requests\Genre\UpdateRequest;
use App\Http\Requests\Genre\DestroyRequest;

class GenreController extends Controller
{
    /**
     * Display a listing of the genres.
     *
     * @param IndexRequest $request
     * @param Index $index
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function index(IndexRequest $request, Index $index)
    {
        return response()->json([
            'message' => 'Successfully fetched the genres.',
            'data' => $index()
        ]);
    }

    /**
     * Store a newly created genre in storage.
     *
     * @param  StoreRequest  $request
     * @param  Store  $store
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function store(StoreRequest $request, Store $store)
    {
        $genre = $store($request->validated());

        return response()->json([
            'message' => 'Successfully stored the genre.',
            'data' => $genre
        ]);
    }

    /**
     * Display the specified genre.
     *
     * @param ShowRequest $request
     * @param Genre $genre
     * @param Show $show
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function show(ShowRequest $request, Genre $genre, Show $show)
    {
        return response()->json([
            'message' => 'Successfully fetched the genre.',
            'data' => $show($genre)
        ]);
    }

    /**
     * Update the specified genre in storage.
     *
     * @param UpdateRequest $request
     * @param Genre $genre
     * @param Update $update
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function update(UpdateRequest $request, Genre $genre, Update $update)
    {
        $updatedGenre = $update($request->validated(), $genre);

        return response()->json([
            'message' => 'Successfully updated the genre.',
            'data' => $updatedGenre
        ]);
    }

    /**
     * Remove the specified genre from storage.
     *
     * @param DestroyRequest $request
     * @param Genre $genre
     * @param Destroy $destroy
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function destroy(DestroyRequest $request, Genre $genre, Destroy $destroy)
    {
        $destroy($genre);

        return response()->json([
            'message' => 'Successfully deleted the genre.'
        ]);
    }
}
