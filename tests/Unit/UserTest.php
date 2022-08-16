<?php

namespace Tests\Unit;

use http\Message;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Helpers\UserHelper;

class UserTest extends TestCase
{
    use UserHelper, DatabaseTransactions;

    /**
     * A basic unit test example.
     */
    public function test_login_user_success()
    {

        $user = $this->createUser();
        $response = $this->withHeaders(['Accept' => 'application/json'])->post("api/login",['loginemail'=>$user->email, 'loginpassword'=>'password']);
        $response->assertOk();
        $this->assertEquals(1, $response['success']);
        $this->assertEquals($user->id, $response['user']['id']);
    }

    public function test_login_user_failed()
    {
        $user = $this->createUser();
        $response = $this->withHeaders(['Accept' => 'application/json'])->post("api/login",['loginemail'=>$user->email, 'loginpassword'=>'fakePassword']);
        $response->assertOk();
        $this->assertEquals(0, $response['success']);
    }

    public function test_register_user_success()
    {
        $user = $this->userFactory();
        $user['password'] = 'password';
        $user['confirmation_password'] = 'password';
        $response = $this->withHeaders(['Accept' => 'application/json'])->post("api/register",$user);
        $response->assertOk();

        $this->assertEquals(1, $response['success']);
    }
    public function test_register_user_failed()
    {
        $user = $this->userFactory();
        $user['password'] = 'password';
        $user['confirmation_password'] = 'fakepassword';
        $response = $this->withHeaders(['Accept' => 'application/json'])->post("api/register", $user);
        $response->assertUnprocessable();

    }


}
