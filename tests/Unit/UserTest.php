<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_have_many_tickets()
    {
        $user = $this->create(\App\User::class);
        $ticket = $this->create(\App\Ticket::class, ['user_id' => $user]);

        $this->assertInstanceOf(\App\Ticket::class, $user->tickets->first());
        $this->assertSame($ticket->owner->name, $user->name);
    }

}
