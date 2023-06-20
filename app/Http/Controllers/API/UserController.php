<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UseCases\CheckEmailService;
use App\Services\UseCases\FindAllUsersService;
use App\Services\UseCases\CreateNewUserService;
use App\Services\UseCases\FindUserByIdService;

class UserController extends Controller
{
    public function __construct(
        protected CheckEmailService $checkEmailService,
        protected CreateNewUserService $createNewUserService,
        protected FindAllUsersService $findAllUsersService,
        protected FindUserByIdService $findUserByIdService
    ) {
    }

    public function store(Request $request)
    {
        $request->validate(User::$validations);

        // Alternative to check if email already existis using Use Case
        $emailAlreadyExistis = $this->checkEmailService->execute($request->email);
        if ($emailAlreadyExistis) {
            return response()->json(['message' => 'Email already existis'], 400);
        }

        // Create new user
        $newUser = $this->createNewUserService->execute($request->all());
        if ($newUser) {
            return response()->json($newUser, 201);
        }

        // If user not created
        return response()->json(['message' => 'User not created'], 400);
    }

    public function index(Request $request)
    {
        return $this->findAllUsersService->execute($request->offset, $request->limit);
    }

    public function show(int $id)
    {
        $user = $this->findUserByIdService->execute($id);
        if ($user) {
            return response()->json($user, 200);
        }
        return response()->json(['message' => 'User not found'], 404);
    }
}
