<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartmentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $department = $this->create(\App\Department::class);

        $this->assertEquals('/api/departments/' . $department->id, $department->path());
    }

    /** @test */
    public function it_belongs_to_a_manager()
    {
        $department = $this->create(\App\Department::class);

        $this->assertInstanceOf(\App\User::class, $department->manager);
    }

    /** @test */
    public function it_can_have_many_tickets()
    {
        $department = $this->create(\App\Department::class);
        $ticket = $this->create(\App\Ticket::class, ['department_id' => $department]);

        $this->assertInstanceOf(\App\Ticket::class, $department->tickets->first());
        $this->assertSame($ticket->department->name, $department->name);
    }

}
