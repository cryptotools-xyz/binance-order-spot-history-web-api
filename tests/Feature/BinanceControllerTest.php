<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Exception;

class BinanceControllerTest extends TestCase
{
    public function test_it_throws_an_exception_if_env_are_missing()
    {
        putenv('BINANCE_API_KEY=');
        putenv('BINANCE_SECRET_KEY=');

        $response = $this->get('/api/all-orders');
        
        $response->assertStatus(500);
    }

    public function test_it_returns_binance_controller()
    {
        $response = $this->get('/api/all-orders');

        $response->assertStatus(200)
                 ->assertJson(['Binance controller']);
    }
}
