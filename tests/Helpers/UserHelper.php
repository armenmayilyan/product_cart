<?php


namespace Tests\Helpers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


trait UserHelper
{
    /**
     * @return array
     */
    protected function userFactory(): array
    {
        $name = Str::random(7);
        $lastname = Str::random(10);

        return [
            'name'            => $name,
            'email'           => $name . $lastname . '@gmail.com',
            'password'        => Hash::make('password'),
            ];

    }

    /**
     * @return User
     */
    public function createUser(): User
    {
        $attributes = $this->userFactory();

        return User::create($attributes);

    }

    /**
     * @return array
     */
    public function createUserAndAuthenticate(): array
    {
        $user = $this->createUser();
        auth()->attempt(['email'=>$user->email, 'password'=>'password']);
        $token = $user->createToken('authToken Token')->accessToken;
        return ['user'=>$user, 'token'=>$token];
    }



}
