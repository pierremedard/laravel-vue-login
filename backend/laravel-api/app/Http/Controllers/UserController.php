<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\RegisterRequest;
use App\Http\Requests\User\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    use Response;

    public function register(RegisterRequest $request): JsonResponse
    {
        User::create($request->validated());
        return $this->returnSuccess([], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->firstOrFail();

        if (!Hash::check($data['password'], $user->password)) {
            return $this->returnError('Wrong Password.', 400);
        }

        $device_name = $request->device_name ?? 'postman';
        $user->tokens()->where('name', $device_name)->delete();
        $token = $user->createToken($device_name, ['*'])->plainTextToken;

        return $this->returnSuccess([ 'token' => $token ], 200);
    }

    public function update_profile(): JsonResponse
    {
        
    }

    public function logout(Request $request): JsonResponse
    {
        Auth::user()->currentAccessToken()->delete();
        return $this->returnSuccess(null, 201);
    }

    public function me(Request $request): JsonResponse
    {
        return $this->returnSuccess(Auth::user(), 200);
    }
}
