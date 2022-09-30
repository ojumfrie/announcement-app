<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Http\Controllers\UserController;

class UserHappyPathTest extends TestCase
{
    public function test_register()
    {
        $this->withoutExceptionHandling();
        $this->post('/api/register', [
            'name' => 'Jane dela Cruz',
            'email' => 'jane.dela.cruz@mail.com',
            'password' => 'flexisourceit',
            'confirm_password' => 'flexisourceit',
            'permission' => '2',
            'active' => '1',
        ])->assertJson([
            'status' => 200,
            'message' => 'User successfully registered!',
        ]);
    }

    public function test_delete()
    {
        $this->withoutExceptionHandling();
        $this->delete('/api/delete-user/2')->assertJson([
            'status' => 200,
            'message' => 'User successfully deleted!',
        ]);
    }

    public function test_login()
    {
        $this->withoutExceptionHandling();
        $this->post('/api/login', [
            'email' => 'jane.dela.cruz@mail.com',
            'password' => 'flexisourceit',
        ])->assertJson([
            'status' => 200,
            'user' => [
                'name' => 'Jane dela Cruz',
                'email' => 'jane.dela.cruz@mail.com',
            ],
        ]);
    }
}
