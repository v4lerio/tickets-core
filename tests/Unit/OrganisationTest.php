<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Collection;

class OrganisationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $organisation = $this->create(\App\Organisation::class);

        $this->assertEquals('/api/organisations/' . $organisation->id, $organisation->path());
    }

    /** @test */
    public function it_has_many_customers()
    {
        $organisation = $this->create(\App\Organisation::class);
        $this->create(\App\Customer::class, ["organisation_id" => $organisation->id] , 10);

        $this->assertInstanceOf(Collection::class, $organisation->customers);
    }

}
