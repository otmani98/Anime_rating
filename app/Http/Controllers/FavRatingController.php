<?php

namespace App\Http\Controllers;

use App\Exceptions\GeneralJsonException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\RatingResource;

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
        return RatingResource::collection($user->ratings);
    }


    public function addOrUpdateRatingToAnime(Request $request) 
    {
        $user = User::find(auth()->user()->id);

        try {
            $user->ratings()->syncWithoutDetaching(array($request->only(['anime_id', 'rating'])));
        } catch (\Throwable $th) {
            DB::table('anime_ratings')
            ->where('user_id', auth()->user()->id)
            ->where('anime_id', $request->anime_id)
            ->update(['rating' => $request->rating]);
        }
        

        $result = $user->ratings->where('id', $request->anime_id);

        return new RatingResource($result[0]);

    }

    public function destroyRatingOfAnime(Request $request) 
    {
        $user = User::find(auth()->user()->id);

        $user->ratings()->detach($request->anime_id);

        return response()->json(['data' => 'success']);
    }
}
