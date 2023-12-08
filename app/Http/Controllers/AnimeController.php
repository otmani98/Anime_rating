<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\AnimeResource;
use App\Exceptions\GeneralJsonException;
use App\Http\Requests\StoreAnimeRequest;

class AnimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $animes = Anime::paginate(($request->pageSize) ? $request->pageSize : 20);

        return AnimeResource::collection($animes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnimeRequest $request)
    {
        $created = DB::transaction(function () use ($request) {
            $created = Anime::create($request->only([
                'title',
                'episodes',
                'release_date',
                'studio_id'
            ]));

            if (!$created) {
            throw new GeneralJsonException('faild to create new anime', 400);
            }

            $created->genres()->sync($request->genre_ids);

            return $created;

        });
        

        return new AnimeResource($created);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anime = Anime::find($id);

        if (!$anime) {
            throw new GeneralJsonException('no anime found with this id', 404);
        }

        return new AnimeResource($anime);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAnimeRequest $request, string $id)
    {
        $anime = Anime::find($id);

        if (!$anime) {
            throw new GeneralJsonException('no anime found with this id', 404);
        }

        $animeupdated = DB::transaction(function () use ($request, $anime) {
            $updated = $anime->update($request->only([
                'title',
                'episodes',
                'release_date',
                'studio_id'
            ]));

            if (!$updated) {
            throw new GeneralJsonException('faild to update anime', 400);
            }

            $anime->genres()->sync($request->genre_ids);

            return $anime;
        });

        return new AnimeResource($animeupdated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = Anime::destroy($id);

        if (!$deleted) {
            throw new GeneralJsonException('faild to delete', 400);
        }

        return response()->json(['data' => 'success']);
    }
}
