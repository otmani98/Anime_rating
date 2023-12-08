<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FavRatingController extends Controller
{
    /**
     *This Controller for fovrites lists of anime those belong to users
     *And the ratings of animes that the users perform
    **/


    /**
     * favorites part
     */
    public function getMyFavoritesAnime(Request $request) {
        $user = User::find(auth()->user()->id);

        return response()->json(['data' => $user->favorites]);
    }


    public function addAnimeToMyFavorites(Request $request, int $animeid) {
        $user = User::find(auth()->user()->id);

        $user->favorites()->syncWithoutDetaching($animeid);

        return response()->json(['data' => $user->favorites]);
    }


    public function destroyAnimeFromMyFavorites(Request $request, int $animeid) {
        $user = User::find(auth()->user()->id);

        $user->favorites()->detach($animeid);

        return response()->json(['data' => 'success']);
    }

    /**
     * ratings part
     */

    public function getMyRatings(Request $request)
    {
        $user = User::find(auth()->user()->id);

        return response()->json(['data' => $user->ratings]);
    }


    public function addRatingToAnime(Request $request) 
    {
        $user = User::find(auth()->user()->id);

        $user->ratings()->syncWithoutDetaching(array($request->only(['anime_id', 'rating'])));

        return response()->json(['data' => $user->ratings]);
    }

    public function destroyRatingOfAnime(Request $request) 
    {
        $user = User::find(auth()->user()->id);

        $user->ratings()->detach($request->anime_id);

        return response()->json(['data' => 'success']);
    }
}
