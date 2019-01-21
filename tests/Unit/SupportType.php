<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SupportType extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $support_type = $this->create(\App\SupportType::class);

        $this->assertEquals('/api/support_types/' . $support_type->id, $support_type->path());
    }
}
