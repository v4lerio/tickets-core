<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Priority extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $priority = $this->create(\App\Priority::class);

        $this->assertEquals('/api/priorities/' . $priority->id, $priority->path());
    }
}
