<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookingTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_has_bookings()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // public function test_index_has_no_bookings()
    // {

    // }

    // public function test_user_can_create_booking()
    // {

    // }

    // public function test_user_can_update_booking()
    // {

    // }

    // public function test_user_can_delete_booking()
    // {
        
    // }
}
