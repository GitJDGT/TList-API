<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Function that receives a request and generates a new
     * personal access TOKEN for the user with the validated data.
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = $this->validate($request);

        // The Auth::attempt method will search for the user
        // in the database with de email provided in the request
        // then it will check if the password provided is the same
        // as the one in the database and then it will return a boolean:
        if(Auth::attempt($credentials))
        {
            $user = User::where('email', $credentials['email'])->first();

            $token = $user->createToken('token')->plainTextToken;

            return response()->json([
                'token' => $token,
                'token_type' => 'Bearer',
            ], 200);
        }

        // In the eventuality that the email provided in the request
        // is nowhere in the database or the password is incorrect
        // the Auth::attempt method will return false.
        return response()->json([
            'message' => 'The provided credentials do not match our records.'
        ], 401);
    }

    /**
     * Function that receives a request and deletes ALL of the
     * personal access TOKENs for the current user.
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Succesfully logged out.',
        ], 200);
    }

    /**
     * Function that receives a request and creates a new user
     * with the validated data.
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $validated = $this->validate($request);

        $user = User::create($validated);

        return response()->json($user, 201);
    }

    /**
     * Function that receives a request and returns the validated data.
     * @param Request $request
     * @return array
     */
    public function validate(Request $request): array
    {
        // This way we can use the same validation rules for the register
        // and login requests. Since Log In will not need the user's name
        // we can exclude it.

        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];

        if(!$request->routeIs('login'))
        {
            $rules['name'] = 'required|string|max:40';
        }

        return $request->validate($rules);
    }
}
