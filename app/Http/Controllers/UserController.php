<?php

namespace App\Http\Controllers;

use App\Models\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserLoginRequest;

use App\Http\Resources\UserResource; // Import UserResource
use App\Http\Requests\UserRegisterRequest; // Pastikan import ini ada dan benar

class UserController extends Controller
{
    public function register(UserRegisterRequest $request): JsonResponse // Ubah tipe return jika perlu
    {
        $data = $request->validated();

        if (User::where('username', $data['username'])->exists()) {
            return response()->json([
                'errors' => [
                    'username' => ["username already registered"]
                ]
            ], 400);
        }

        $user = new User($data);
        $user->password = Hash::make($data['password']); // Perbaikan disini juga
        $user->save();

        return (new UserResource($user))->response()->setStatusCode(201); // atau return response()->json(new UserResource($user), 201);
    }

    public function login(UserLoginRequest $request): JsonResponse {
        $data = $request->validated();

        $user = User::where('username', $data['username'])->first();
    }
}