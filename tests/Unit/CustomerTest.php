<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $customer = $this->create(\App\Customer::class);

        $this->assertEquals('/api/customers/' . $customer->id, $customer->path());
    }

    /** @test */
    public function it_belongs_to_an_organisation()
    {
        $customer = $this->create(\App\Customer::class);

        $this->assertInstanceOf(\App\Organisation::class, $customer->organisation);
    }

    /** @test */
    public function it_can_have_many_tickets()
    {
        $customer = $this->create(\App\Customer::class);
        $ticket = $this->create(\App\Ticket::class, ['customer_id' => $customer]);

        $this->assertInstanceOf(\App\Ticket::class, $customer->tickets->first());
        $this->assertSame($ticket->customer->name, $customer->name);
    }

}
