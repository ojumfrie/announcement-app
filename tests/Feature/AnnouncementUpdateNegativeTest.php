<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Http\Controllers\AnnouncementController;

class AnnouncementUpdateNegativeTest extends TestCase
{
    // ---ID---

    public function test_update_w_id_empty()
    {
        $response = $this->put('/api/update-announcement/', [
                    'title' => 'The Christmas Party!',
                    'content' => 'This is a christmas time party!',
                    'start_date' => '2022-09-02',
                    'end_date' => '2022-09-03',
                    'active' => '1',
        ]);

        $response->assertStatus(404);
    }

    public function test_update_w_id_does_not_exist()
    {
        $this->withoutExceptionHandling();
        $response = $this->put('/api/update-announcement/100', [
                    'title' => 'The Christmas Party!',
                    'content' => 'This is a christmas time party!',
                    'start_date' => '2022-09-02',
                    'end_date' => '2022-09-03',
                    'active' => '1',
        ]);

        $response->assertJSON([
            "status" => 404,
            "message" => "Announcement ID cannot be found.",
        ]);
    }

    public function test_update_w_id_nan()
    {
        $this->withoutExceptionHandling();
        $response = $this->put('/api/update-announcement/abcde', [
                    'title' => 'The Christmas Party!',
                    'content' => 'This is a christmas time party!',
                    'start_date' => '2022-09-02',
                    'end_date' => '2022-09-03',
                    'active' => '1',
        ]);

        $response->assertJSON([
            "status" => 404,
            "message" => "Announcement ID cannot be found.",
        ]);
    }

    // ---TITLE FIELD---

    public function test_update_w_title_empty()
    {
        $this->withoutExceptionHandling();
        $response = $this->put('/api/update-announcement/1', [
                    'title' => '',
                    'content' => 'This is a christmas time party!',
                    'start_date' => '2022-09-02',
                    'end_date' => '2022-09-03',
                    'active' => '1',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    public function test_update_w_title_beyond_max()
    {
        $this->withoutExceptionHandling();
        $response = $this->put('/api/update-announcement/1', [
                    'title' => 'The Christmas Party! The Christmas Party! The Christmas Party! The Christmas Party! The Christmas Party! The Christmas Party! The Christmas Party! The Christmas Party! The Christmas Party! The Christmas Party! The Christmas Party! The Christmas Party! The Christmas Party! The Christmas Party! The Christmas Party!',
                    'content' => 'This is a christmas time party!',
                    'start_date' => '2022-09-02',
                    'end_date' => '2022-09-03',
                    'active' => '1',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    // ---CONTENT FIELD---

    public function test_update_w_content_empty()
    {
        $this->withoutExceptionHandling();
        $response = $this->put('/api/update-announcement/1', [
                    'title' => 'The Christmas Party!',
                    'content' => '',
                    'start_date' => '2022-09-02',
                    'end_date' => '2022-09-03',
                    'active' => '1',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    public function test_update_w_content_beyond_max()
    {
        $this->withoutExceptionHandling();
        $response = $this->put('/api/update-announcement/1', [
                    'title' => 'The Christmas Party!',
                    'content' => 'This is a christmas time party! This is a christmas time party! This is a christmas time party! This is a christmas time party! This is a christmas time party! This is a christmas time party! This is a christmas time party! This is a christmas time party! This is a christmas time party! This is a christmas time party! This is a christmas time party! This is a christmas time party! This is a christmas time party! This is a christmas time party! This is a christmas time party! This is a christmas time party! This is a christmas time party! This is a christmas time party! This is a christmas time party! This is a christmas time party! This is a christmas time party! This is a christmas time party! This is a christmas time party! This is a christmas time party! This is a christmas time party! This is a christmas time party!',
                    'start_date' => '2022-09-02',
                    'end_date' => '2022-09-03',
                    'active' => '1',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    // ---START_DATE FIELD---

    public function test_update_w_startdate_empty()
    {
        $this->withoutExceptionHandling();
        $response = $this->put('/api/update-announcement/1', [
                    'title' => 'The Christmas Party!',
                    'content' => 'This is a christmas time party!',
                    'start_date' => '',
                    'end_date' => '2022-09-03',
                    'active' => '1',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    // ---END_DATE FIELD---
    
    public function test_update_w_enddate_empty()
    {
        $this->withoutExceptionHandling();
        $response = $this->put('/api/update-announcement/1', [
                    'title' => 'The Christmas Party!',
                    'content' => 'This is a christmas time party!',
                    'start_date' => '2022-09-02',
                    'end_date' => '',
                    'active' => '1',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    // ---ACTIVE FIELD---

    public function test_update_w_active_empty()
    {
        $this->withoutExceptionHandling();
        $response = $this->put('/api/update-announcement/1', [
                    'title' => 'The Christmas Party!',
                    'content' => 'This is a christmas time party!',
                    'start_date' => '2022-09-02',
                    'end_date' => '2022-09-03',
                    'active' => '',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    public function test_update_w_active_nan()
    {
        $this->withoutExceptionHandling();
        $response = $this->put('/api/update-announcement/1', [
                    'title' => 'The Christmas Party!',
                    'content' => 'This is a christmas time party!',
                    'start_date' => '2022-09-02',
                    'end_date' => '2022-09-03',
                    'active' => 'abcde',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }
}
