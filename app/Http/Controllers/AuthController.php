<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\GetAuthUserResource;
use App\Http\Resources\LoginResource;
use App\Models\User;
use App\Repository\UserRepository;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\RegisterResource;
use Mockery\Exception;

class AuthController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepo;

    /**
     * AuthController constructor.
     * @param UserRepository $userRepo
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * @param LoginRequest $loginRequest
     * @return JsonResponse
     */
    public function login(LoginRequest $loginRequest)
    {
        if (Auth::guard('web')->attempt(['email' => $loginRequest->loginemail, 'password' => $loginRequest->loginpassword])) {
            $accessToken = auth()->user()->createToken('authToken')->accessToken;
            return response()->json([
                'success' => 1,
                'user' => auth()->user(),
                'token' => $accessToken
            ]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * @param RegisterRequest $registerRequest
     * @return JsonResponse
     */

    public function register(RegisterRequest $registerRequest)
    {
            $data = [
                'name' => $registerRequest->input('name'),
                'email' => $registerRequest->input('email'),
                'password' => Hash::make($registerRequest->input('password')),
            ];
            $this->userRepo->create($data);
            return response()->json(['success' => 1]);


    }


    /**
     * @return GetAuthUserResource]
     */
    public function getAuthUser()
    {
        return new GetAuthUserResource(['success' => 1, 'auth' => auth()->user()]);
    }

    /**
     * @return JsonResponse
     */
    public function logout()
    {

        $user = Auth::user()->token('authToken');
        $user->revoke();
        return response()->json(['success' => 1]);

    }


}
