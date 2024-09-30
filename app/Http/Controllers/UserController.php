<?php

namespace App\Http\Controllers;

use App\Exceptions\DatabaseExeption;
use App\Exceptions\UserAlreadyExistsException;
use App\Exceptions\UserNotFound;
use App\Http\Requests\UserFormRequest;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService; 
    }

    public function index() : JsonResponse
    {
        $users = $this->userService->GetAll();
        return response()->json([
            'success' => true,
            'data' => $users,
            'message' => "users retrieved successfully"
        ], 200);
    }
    
    public function show(User $user) : JsonResponse
    {
        if ($user === null)
        {
            throw new UserNotFound();
        }

        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => "user retrieved successfully"
        ], 200);
    }

    public function store(UserFormRequest $request) : JsonResponse
    {
        $this->userService->Create($request);
        return response()->json([
            'success' => true,
            'message' => "User created successfully"
        ], 201);
    }
    
    public function update(UserFormRequest $request, User $user) : JsonResponse
    {
        $this->userService->Update($request, $user);
        return response()->json([
            'success' => true,
            'message' => "The user was modified successfully"
        ], 200);
    }

    public function destroy(User $user) : JsonResponse
    {
        DB::beginTransaction();
        try 
        {
            $user->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "The user was removed successfully"
            ], 200);
        }
        catch(Exception $ex)
        {
            DB::rollBack();
            throw new Exception("An error occurred when trying to delete the user");
        } 
    }
}
