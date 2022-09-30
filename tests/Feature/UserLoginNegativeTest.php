<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Http\Controllers\UserController;

class UserLoginNegativeTest extends TestCase
{
    // ---DOES NOT MATCH TO ANY IN THE RECORDS---

    public function test_login_creds_does_not_match()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/login', [
            'email' => 'jane.dela.cruz@mail.com',
            'password' => 'flexisourceit-exaggeration',
        ])->assertJson([
            'status' => 404,
            'message' => 'Credentials provide did not match.',
        ]);
    }

    // ---EMAIL FIELD---

    public function test_login_w_email_empty()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/login', [
            'email' => '',
            'password' => 'flexisourceit',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    public function test_login_w_email_integer()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/login', [
            'email' => 12345,
            'password' => 'flexisourceit',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }
    
    public function test_login_w_email_not_email()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/login', [
            'email' => 'juan.dela.cruz',
            'password' => 'flexisourceit',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    public function test_login_w_email_beyond_max()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/login', [
            'email' => 'juan.dela.cruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruz@mail.com',
            'password' => 'flexisourceit',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    // ---PASSWORD FIELD---

    public function test_login_w_password_empty()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/login', [
            'email' => 'juan.dela.cruz@mail.com',
            'password' => '',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    public function test_login_w_password_integer()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/login', [
            'email' => 'juan.dela.cruz@mail.com',
            'password' => 12345,
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    public function test_login_w_password_below_min()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/login', [
            'email' => 'juan.dela.cruz@mail.com',
            'password' => 'flexi',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }
}
