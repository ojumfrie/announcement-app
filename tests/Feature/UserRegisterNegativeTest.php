<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Http\Controllers\UserController;

class UserRegisterNegativeTest extends TestCase
{
    // ---NAME FIELD---

    public function test_register_w_name_empty()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/register', [
            'name' => '',
            'email' => 'juan.dela.cruz@mail.com',
            'password' => 'flexisourceit',
            'confirm_password' => 'flexisourceit',
            'permission' => '2',
            'active' => '1',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    public function test_register_w_name_integer()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/register', [
            'name' => 12345,
            'email' => 'justine.dela.cruz@mail.com',
            'password' => 'flexisourceit',
            'confirm_password' => 'flexisourceit',
            'permission' => '2',
            'active' => '1',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    public function test_register_w_name_beyond_max()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/register', [
            'name' => 'Juan dela Cruz Juan dela Cruz Juan dela Cruz Juan dela Cruz Juan dela Cruz Juan dela Cruz Juan dela Cruz Juan dela Cruz Juan dela Cruz Juan dela Cruz Juan dela Cruz Juan dela Cruz Juan dela Cruz Juan dela Cruz Juan dela Cruz Juan dela Cruz Juan dela Cruz Juan dela Cruz Juan dela Cruz Juan dela Cruz',
            'email' => 'justine.dela.cruz@mail.com',
            'password' => 'flexisourceit',
            'confirm_password' => 'flexisourceit',
            'permission' => '2',
            'active' => '1',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    // ---EMAIL FIELD---

    public function test_register_w_email_empty()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/register', [
            'name' => 'Juan dela Cruz',
            'email' => '',
            'password' => 'flexisourceit',
            'confirm_password' => 'flexisourceit',
            'permission' => '2',
            'active' => '1',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    public function test_register_w_email_integer()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/register', [
            'name' => 'Juan dela Cruz',
            'email' => 12345,
            'password' => 'flexisourceit',
            'confirm_password' => 'flexisourceit',
            'permission' => '2',
            'active' => '1',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    public function test_register_w_email_non_email()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/register', [
            'name' => 'Juan dela Cruz',
            'email' => 'juan.dela.cruz',
            'password' => 'flexisourceit',
            'confirm_password' => 'flexisourceit',
            'permission' => '2',
            'active' => '1',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    public function test_register_w_email_beyond_max()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/register', [
            'name' => 'Juan dela Cruz',
            'email' => 'juan.dela.cruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruzcruz@mail.com',
            'password' => 'flexisourceit',
            'confirm_password' => 'flexisourceit',
            'permission' => '2',
            'active' => '1',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    // ---PASSWORD FIELD---

    public function test_register_w_password_empty()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/register', [
            'name' => 'Juan dela Cruz',
            'email' => 'justine.dela.cruz@mail.com',
            'password' => '',
            'confirm_password' => 'flexisourceit',
            'permission' => '2',
            'active' => '1',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    public function test_register_w_password_integer()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/register', [
            'name' => 'Juan dela Cruz',
            'email' => 'justine.dela.cruz@mail.com',
            'password' => 12345,
            'confirm_password' => 'flexisourceit',
            'permission' => '2',
            'active' => '1',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    public function test_register_w_password_below_min()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/register', [
            'name' => 'Juan dela Cruz',
            'email' => 'justine.dela.cruz@mail.com',
            'password' => 'flexi',
            'confirm_password' => 'flexisourceit',
            'permission' => '2',
            'active' => '1',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    // ---CONFIRM PASSWORD FIELD---

    public function test_register_w_confirm_password_empty()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/register', [
            'name' => 'Juan dela Cruz',
            'email' => 'justine.dela.cruz@mail.com',
            'password' => '',
            'confirm_password' => 'flexisourceit',
            'permission' => '2',
            'active' => '1',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    public function test_register_w_confirm_password_integer()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/register', [
            'name' => 'Juan dela Cruz',
            'email' => 'justine.dela.cruz@mail.com',
            'password' => 12345,
            'confirm_password' => 'flexisourceit',
            'permission' => '2',
            'active' => '1',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    public function test_register_w_confirm_password_below_min()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/register', [
            'name' => 'Juan dela Cruz',
            'email' => 'justine.dela.cruz@mail.com',
            'password' => 'flexi',
            'confirm_password' => 'flexisourceit',
            'permission' => '2',
            'active' => '1',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    // ---PERMISSION FIELD---

    public function test_register_w_permission_empty()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/register', [
            'name' => 'Juan dela Cruz',
            'email' => 'justine.dela.cruz@mail.com',
            'password' => 'flexisourceit',
            'confirm_password' => 'flexisourceit',
            'permission' => '',
            'active' => '1',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    public function test_register_w_permission_nan()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/register', [
            'name' => 'Juan dela Cruz',
            'email' => 'justine.dela.cruz@mail.com',
            'password' => 'flexisourceit',
            'confirm_password' => 'flexisourceit',
            'permission' => 'abcde',
            'active' => '1',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    // ---ACTIVE FIELD---

    public function test_register_w_active_empty()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/register', [
            'name' => 'Juan dela Cruz',
            'email' => 'justine.dela.cruz@mail.com',
            'password' => 'flexisourceit',
            'confirm_password' => 'flexisourceit',
            'permission' => '3',
            'active' => '',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    public function test_register_w_active_nan()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/register', [
            'name' => 'Juan dela Cruz',
            'email' => 'justine.dela.cruz@mail.com',
            'password' => 'flexisourceit',
            'confirm_password' => 'flexisourceit',
            'permission' => '3',
            'active' => 'abcde',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }
}
