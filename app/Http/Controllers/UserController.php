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

        return response()->json(['data' => $users]);
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

        if ($rule === 1 || $rule === 2) {
            $user->update(['role_id' => $rule]);
        }

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
