<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testCorrectOrder(): void
    {
        $order = [
            'id' => "A0000001",
            'name' => "Melody Holiday Inn",
            "address" => [
                "city"=> "taipei-city",
                "district"=> "da-an-district",
                "street"=> "fuxing-south-road"
            ],
            'price' => 1050,
            'currency' => "TWD",
        ];


        $response = $this->postJson('/api/orders', $order);

        $response
        ->assertStatus(200)
        ->assertJson([
            'message' => 'Order processed successfully',
            'data' => [
                'id' => "A0000001",
                'name' => "Melody Holiday Inn",
                "address" => [
                    "city"=> "taipei-city",
                    "district"=> "da-an-district",
                    "street"=> "fuxing-south-road"
                ],
                'price' => 1050,
                'currency' => "TWD",
            ]
        ]);
    }

    public function testNonEnglishOrder(): void
    {
        $order = [
            'id' => "A0000001",
            'name' => "Melody Holiday Inn一二三",
            "address" => [
                "city"=> "taipei-city",
                "district"=> "da-an-district",
                "street"=> "fuxing-south-road"
            ],
            'price' => 1050,
            'currency' => "TWD",
        ];


        $response = $this->postJson('/api/orders', $order);

        $response
        ->assertStatus(400)
        ->assertJson([
            'message' => 'Name contains non-English characters',
        ]);
    }

    public function testPriceIsOver2000Order(): void
    {
        $order = [
            'id' => "A0000001",
            'name' => "Melody Holiday Inn",
            "address" => [
                "city"=> "taipei-city",
                "district"=> "da-an-district",
                "street"=> "fuxing-south-road"
            ],
            'price' => 2050,
            'currency' => "TWD",
        ];


        $response = $this->postJson('/api/orders', $order);

        $response
        ->assertStatus(400)
        ->assertJson([
            'message' => 'Price is over 2000',
        ]);
    }

    public function testCurrencyFormatIsWrongOrder(): void
    {
        $order = [
            'id' => "A0000001",
            'name' => "Melody Holiday Inn",
            "address" => [
                "city"=> "taipei-city",
                "district"=> "da-an-district",
                "street"=> "fuxing-south-road"
            ],
            'price' => 1050,
            'currency' => "JPY",
        ];


        $response = $this->postJson('/api/orders', $order);

        $response
        ->assertStatus(400)
        ->assertJson([
            'message' => 'Currency format is wrong',
        ]);
    }

    public function testUSDtoTWDOrder(): void
    {
        $order = [
            'id' => "A0000001",
            'name' => "Melody Holiday Inn",
            "address" => [
                "city"=> "taipei-city",
                "district"=> "da-an-district",
                "street"=> "fuxing-south-road"
            ],
            'price' => 50,
            'currency' => "USD",
        ];


        $response = $this->postJson('/api/orders', $order);

        $response
        ->assertStatus(200)
        ->assertJson([
            'message' => 'Order processed successfully',
            'data' => [
                'id' => "A0000001",
                'name' => "Melody Holiday Inn",
                "address" => [
                    "city"=> "taipei-city",
                    "district"=> "da-an-district",
                    "street"=> "fuxing-south-road"
                ],
                'price' => $order['price'] * 31,
                'currency' => "TWD",
            ]
        ]);
    }
}
