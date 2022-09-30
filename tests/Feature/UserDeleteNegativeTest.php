<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Http\Controllers\UserController;

class UserDeleteNegativeTest extends TestCase
{
    public function test_delete_w_id_empty()
    {
        $response = $this->get('/api/delete-user/');
        $response->assertStatus(404);
    }

    public function test_delete_w_id_does_not_exist()
    {
        $response = $this->delete('/api/delete-user/100');
        $response->assertJson([
            'status' => 404,
            'message' => 'User ID Not Found.',
        ]);
    }

    public function test_delete_w_id_nan()
    {
        $response = $this->delete('/api/delete-user/abcde');
        $response->assertJson([
            'status' => 404,
            'message' => 'User ID Not Found.',
        ]);
    }
}