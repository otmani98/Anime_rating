<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use App\Exceptions\GeneralJsonException;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $genres = Genre::all();

        return response()->json(['data' => $genres]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $created = Genre::create($request->all());

        return response()->json(['data' => $created]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            throw new GeneralJsonException('no genre found with this id', 404);
        }

        //-add animes
        $genre->animes;

        return response()->json(['data' => $genre]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            throw new GeneralJsonException('no genre found with this id', 404);
        }
        
        $updated = $genre->update($request->all());

        if (!$updated) {
            throw new GeneralJsonException('faild to update', 400);
        }

        return response()->json(['data' => $genre]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = Genre::destroy($id);

        if (!$deleted) {
            throw new GeneralJsonException('faild to delete', 400);
        }

        return response()->json(['data' => 'success']);
    }
}
