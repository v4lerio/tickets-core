<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Ticket extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $ticket = $this->create(\App\Ticket::class);

        $this->assertEquals('/api/tickets/' . $ticket->id, $ticket->path());
    }
}
