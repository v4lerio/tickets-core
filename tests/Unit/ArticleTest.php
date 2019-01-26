<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_ticket()
    {
        $article = $this->create(\App\Article::class);

        $this->assertInstanceOf(\App\Ticket::class, $article->ticket);
    }


}
