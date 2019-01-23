<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SupportTypeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $support_type = $this->create(\App\SupportType::class);

        $this->assertEquals('/api/support_types/' . $support_type->id, $support_type->path());
    }

    /** @test */
    public function it_can_have_a_parent()
    {
        $support_type_parent = $this->create(\App\SupportType::class);
        $support_type_child = $this->create(\App\SupportType::class, ['parent_id' => $support_type_parent->id]);

        $this->assertInstanceOf(\App\SupportType::class, $support_type_child->parent);
        $this->assertSame($support_type_parent->id, $support_type_child->parent->id);
    }

    /** @test */
    public function it_can_have_a_child()
    {
        $support_type_parent = $this->create(\App\SupportType::class);
        $support_type_child = $this->create(\App\SupportType::class, ['parent_id' => $support_type_parent->id]);

        $this->assertInstanceOf(\App\SupportType::class, $support_type_parent->children[0]);
        $this->assertSame($support_type_child->id, $support_type_parent->children[0]->id);
    }

    /** @test */
    public function it_can_have_many_tickets()
    {
        $support_type = $this->create(\App\SupportType::class);
        $ticket = $this->create(\App\Ticket::class, ['support_type_id' => $support_type]);

        $this->assertInstanceOf(\App\Ticket::class, $support_type->tickets->first());
        $this->assertSame($ticket->support_type->name, $support_type->name);
    }

}
