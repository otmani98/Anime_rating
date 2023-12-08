<?php

namespace App\Http\Controllers;

use App\Exceptions\GeneralJsonException;
use App\Models\Studio;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $studios = Studio::paginate(($request->pageSize) ? $request->pageSize : 20);

        return response()->json($studios);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $created = Studio::create($request->all());

        if (!$created) {
            throw new GeneralJsonException('faild to create new studio', 400);
        }

        return response()->json($created);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $studio = Studio::find($id);

        if (!$studio) {
            throw new GeneralJsonException('no studio found with this id', 404);
        }

        //add its works
        $studio->animes;

        return response()->json($studio);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $studio = Studio::find($id);

        if (!$studio) {
            throw new GeneralJsonException('no studio found with this id', 404);
        }
        
        $updated = $studio->update($request->all());

        if (!$updated) {
            throw new GeneralJsonException('faild to update', 400);
        }

        return response()->json($studio);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = Studio::destroy($id);

        if (!$deleted) {
            throw new GeneralJsonException('faild to delete', 400);
        }

        return response()->json(['data' => 'success']);
    }
}
