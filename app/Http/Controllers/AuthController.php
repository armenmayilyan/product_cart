<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\GetAuthUserResource;
use App\Http\Resources\LoginResource;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\RegisterResource;

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

    public function login(LoginRequest $loginRequest)
    {
        if (Auth::guard('web')->attempt(['email' => $loginRequest->loginemail, 'password' => $loginRequest->loginpassword])) {
            $accessToken = auth()->user()->createToken('authToken')->accessToken;
            return new LoginResource(['success' => 1, 'user' => auth()->user(), 'access_token' => $accessToken]);
        } else {
            return ['success'=>false];
        }
    }

    public function register(RegisterRequest $registerRequest)
    {
        $data = [
            'name' => $registerRequest->input('name'),
            'email' => $registerRequest->input('email'),
            'password' => Hash::make($registerRequest->input('password')),
        ];

        $this->userRepo->create($data);
        return new RegisterResource(['success' => 1]);

    }

    /**
     * @return GetAuthUserResource
     */
    public function getAuthUser()
    {
        return new GetAuthUserResource(['success' => 1, 'auth' => auth()->user()]);
    }
    public function logout()
    {
        $user = Auth::user()->token('authToken');
        $user->revoke();

        return new RegisterResource(['success' => 1]);

    }


}
