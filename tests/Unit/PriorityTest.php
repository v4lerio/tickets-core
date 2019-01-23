<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PriorityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $priority = $this->create(\App\Priority::class);

        $this->assertEquals('/api/priorities/' . $priority->id, $priority->path());
    }

    /** @test */
    public function it_can_have_many_tickets()
    {
        $priority = $this->create(\App\Priority::class);
        $ticket = $this->create(\App\Ticket::class, ['priority_id' => $priority]);
        
        $this->assertInstanceOf(\App\Ticket::class, $priority->tickets->first());
        $this->assertSame($ticket->priority->name, $priority->name);
    }

}
