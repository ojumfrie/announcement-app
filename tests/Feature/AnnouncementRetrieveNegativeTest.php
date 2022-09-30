<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Http\Controllers\AnnouncementController;

class AnnouncementRetrieveNegativeTest extends TestCase
{
    public function test_retrieve_w_id_does_not_exist()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/api/edit-announcement/100');
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 404,
            'message' => "Announcement ID not found.",
         ]);
    }

    public function test_retrieve_w_id_nan()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/api/edit-announcement/abcde');
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 404,
            'message' => "Announcement ID not found.",
         ]);
    }
}
