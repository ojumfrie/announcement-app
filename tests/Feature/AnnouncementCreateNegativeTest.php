<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Http\Controllers\AnnouncementController;

class AnnouncementCreateNegativeTest extends TestCase
{
    // ---TITLE FIELD---

    public function test_create_w_title_empty()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/create-announcement', [
                    'title' => '',
                    'content' => 'This is a christmas time party!',
                    'start_date' => '2022-09-02',
                    'end_date' => '2022-09-03',
                    'active' => '1',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    public function test_create_w_title_beyond_max()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/create-announcement', [
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

    public function test_create_w_content_empty()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/create-announcement', [
                    'title' => 'The Christmas Party!',
                    'content' => '',
                    'start_date' => '2022-09-02',
                    'end_date' => '2022-09-03',
                    'active' => '1',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    public function test_create_w_content_beyond_max()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/create-announcement', [
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

    public function test_create_w_startdate_empty()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/create-announcement', [
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
    
    public function test_create_w_enddate_empty()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/create-announcement', [
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

    public function test_create_w_active_empty()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/create-announcement', [
                    'title' => 'The Christmas Party!',
                    'content' => 'This is a christmas time party!',
                    'start_date' => '2022-09-02',
                    'end_date' => '2022-09-03',
                    'active' => '',
        ]);

        $temp_arr = (array)json_decode($response->content());
        $this->assertArrayHasKey('validation_error', $temp_arr);
    }

    public function test_create_w_active_nan()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/create-announcement', [
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
