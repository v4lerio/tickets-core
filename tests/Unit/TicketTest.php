<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Collection;

class TicketTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $ticket = $this->create(\App\Ticket::class);

        $this->assertEquals('/api/tickets/' . $ticket->id, $ticket->path());
    }

    /** @test */
    public function it_has_an_owner() {
        $ticket = $this->create(\App\Ticket::class);

        $this->assertInstanceOf(\App\User::class, $ticket->owner);
    }

    /** @test */
    public function it_belongs_to_a_customer()
    {
        $ticket = $this->create(\App\Ticket::class);

        $this->assertInstanceOf(\App\Customer::class, $ticket->customer);
    }

    /** @test */
    public function it_belongs_to_a_department() {
        $ticket = $this->create(\App\Ticket::class);

        $this->assertInstanceOf(\App\Department::class, $ticket->department);
    }

    /** @test */
    public function it_belongs_to_a_support_type() {
        $ticket = $this->create(\App\Ticket::class);

        $this->assertInstanceOf(\App\SupportType::class, $ticket->support_type);
    }

    /** @test */
    public function it_belongs_to_a_priority()
    {
        $ticket = $this->create(\App\Ticket::class);

        $this->assertInstanceOf(\App\Priority::class, $ticket->priority);
    }

    /** @test */
    public function it_has_many_articles() {
        $ticket = $this->create(\App\Ticket::class);
        $articles = $this->create(\App\Article::class, ['ticket_id' => $ticket->id], 5);

        $this->assertInstanceOf(Collection::class, $ticket->articles);
    }

}
