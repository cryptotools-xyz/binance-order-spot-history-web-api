<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BinanceControllerTest extends TestCase
{
    public function test_example()
    {
        $response = $this->get('/api/all-orders');

        $response->assertStatus(200)
                 ->assertJson(['Binance controller']);
    }
}
