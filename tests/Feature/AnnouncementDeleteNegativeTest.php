<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Http\Controllers\AnnouncementController;

class AnnouncementDeleteNegativeTest extends TestCase
{
    public function test_delete_w_id_empty()
    {
        $response = $this->get('/api/delete-announcement/');
        $response->assertStatus(404);
    }

    public function test_delete_w_id_does_not_exist()
    {
        $response = $this->delete('/api/delete-announcement/100');
        $response->assertJson([
            'status' => 404,
            'message' => 'Announcement ID passed does not much any in the records.',
        ]);
    }

    public function test_delete_w_id_nan()
    {
        $response = $this->get('/api/delete-announcement/abcde');
        $response->assertStatus(405);
    }
}
