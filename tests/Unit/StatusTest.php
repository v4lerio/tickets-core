<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $status = $this->create(\App\Status::class);

        $this->assertEquals('/api/statuses/' . $status->id, $status->path());
    }

    /** @test */
    public function it_can_have_many_tickets()
    {
        $status = $this->create(\App\Status::class);
        $ticket = $this->create(\App\Ticket::class, ['status_id' => $status]);

        $this->assertInstanceOf(\App\Ticket::class, $status->tickets->first());
        $this->assertSame($ticket->status->name, $status->name);
    }

    /** @test */
    public function it_has_a_public_state_types_property()
    {
        $this->assertSame(['open', 'closed', 'archived'], \App\Status::$state_types);
    }


}
