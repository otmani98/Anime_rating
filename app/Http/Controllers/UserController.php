<?php

namespace App\Http\Controllers;

use App\Exceptions\GeneralJsonException;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    //auth()->user()->id

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::paginate(($request->pageSize) ? $request->pageSize : 20);

        // return AnimeResource::collection($animes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    /**
     * change role of user from user to admin or or vice versa
    **/
    public function changeRule($userName, int $rule)
    {
        $user = User::where('userName', $userName)->first();

        if (!$user) {
            throw new GeneralJsonException('There is no user with this username', 404);
        }

        $user->update(['role_id' => $rule]);

        return response()->json(['data' => $user]);
    }

    /**
     * to block or disblock user 
    **/
    public function toggleUserActive($userName, int $status)
    {
        $user = User::where('userName', $userName)->first();

        if (!$user) {
            throw new GeneralJsonException('There is no user with this username', 404);
        }

        if ($status === 0 || $status === 1) {
            $user->update(['active' => $status]);
        }

        return response()->json(['data' => $user]);
    }

}
