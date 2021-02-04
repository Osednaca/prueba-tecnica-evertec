<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\DuskTestCase;
use Laravel\Dusk\Chrome;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function status_displays_the_status_view()
    {
        $response = $this->get('/order/2');
        $response->assertStatus(200);
        $response->assertViewIs('orders.status');

        // Assert
        // Search for the order details
        $response->assertSee('APPROVED');
    }

    /** @test */
    public function create_new_order()
    {
        $customer_document_type = "CC";
        $customer_document      = "123456";
        $customer_name          = $this->faker->name;
        $customer_last_name     = $this->faker->name;
        $customer_email         = $this->faker->safeEmail;
        $customer_mobile        = 3101234567;

        $response = $this->post(route('store'), [
            'customer_name' => $customer_name,
            'customer_last_name' => $customer_last_name,
            'customer_email' => $customer_email,
            'customer_mobile' => $customer_mobile,
            'customer_document' => $customer_document,
            'customer_document_type' => $customer_document_type,
        ]);

        $response->assertViewIs('orders.summary');

        $this->assertDatabaseHas('orders', [
            'customer_name' => $customer_name
        ]);
    }
}
