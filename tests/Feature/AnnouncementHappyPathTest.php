<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Http\Controllers\AnnouncementController;

class AnnouncementHappyPathTest extends TestCase
{
    public function test_create()
    {
        $this->withoutExceptionHandling();
        $this->post('/api/create-announcement', [
                    'title' => 'The Dejavou Party - third batch',
                    'content' => 'This is a party about dejavou - third batch',
                    'start_date' => '2022-09-02',
                    'end_date' => '2022-09-03',
                    'active' => '1',
                ])
             ->assertJson([
                'status' => 200,
                'message' => "Announcement successfully added!",
             ]);
    }

    public function test_retrieve()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/api/edit-announcement/1');
        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('announcement', $temp_arr);
        $this->assertArrayHasKey('status', $temp_arr);
    }

    public function test_update()
    {
        $this->withoutExceptionHandling();
        $this->put('/api/update-announcement/1', [
                    'title' => 'The Dejavou Party and more party',
                    'content' => 'This is a party about dejavou',
                    'start_date' => '2022-09-02',
                    'end_date' => '2022-09-03',
                    'active' => '1',
                ])
             ->assertJson([
                'status' => 200,
                'message' => "Announcement successfully updated!",
             ]);
    }

    public function test_delete()
    {
        $this->withoutExceptionHandling();
        $this->delete('/api/delete-announcement/9')
             ->assertJson([
                'status' => 200,
                'message' => "Announcement successfully deleted!",
             ]);
    }
}
