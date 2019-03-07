<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $email = $this->create(\App\Email::class);

        $this->assertEquals('/api/emails/' . $email->id, $email->path());
    }
}
