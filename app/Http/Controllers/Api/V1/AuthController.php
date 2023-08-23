<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $key = auth()->user()->createToken('access_token');

        return Response::json(
            ['token' => $key->plainTextToken]
        );
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return Response::json([
            'message' => __('messages.personal_access_tokens_deleted')
            ]);
    }
}
