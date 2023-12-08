<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\AuthResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AuthLoginRequest;
use App\Exceptions\GeneralJsonException;
use App\Http\Requests\AuthRegisterRequest;

class AuthController extends Controller
{
    /**
     * Register (New account user).
    **/
    public function register(AuthRegisterRequest $request)
    {
        $fields = $request->only([
            'firstName',
            'lastName',
            'userName',
            'email',
            'password',
        ]);

        $fields['password'] = bcrypt($request->password);

        $newUser = User::create($fields);
        $newUser->role;

        $token = $newUser->createToken('api-access-token')->plainTextToken;

        return new AuthResource(['user' => $newUser, 'token' => $token]);

    }

    /**
     * Login (account user).
    **/

    public function login(AuthLoginRequest $request)
    {
        $fields = $request->only([
            'email',
            'password',
        ]);

        $user = User::where('email', $fields['email'])->first();
        $user->role;

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            throw new GeneralJsonException('email or password are wrong', 401);
        }

        if (!$user->active) {
            throw new GeneralJsonException('your account suspended', 401);
        }

        $token = $user->createToken('api-access-token')->plainTextToken;

        return new AuthResource(['user' => $user, 'token' => $token]);
    }


    /**
     * Logout (account user).
    **/
    public function logout(Request $request)
    {
        // dd(auth()->user()->role_id);
        auth()->user()->tokens()->delete();
        return response()->json(['status' => 'success']);
    }
}

