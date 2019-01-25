<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp()
    {
        parent::setUp();
        $this->signIn();
    }

    /** @test */
    public function we_can_fetch_tickets()
    {
        $ticket = $this->create(\App\Ticket::class);

        $this->json('GET', '/api/tickets')
            ->assertStatus(200)
            ->assertJsonFragment([
                'user_id' => $ticket->user_id,
                'customer_id' => $ticket->customer_id,
                'department_id' => $ticket->department_id,
                'support_type_id' => $ticket->support_type_id,
                'priority_id' => $ticket->priority_id,
                'subject' => $ticket->subject,
                'state' => $ticket->state,
            ]);
    }

    /** @test */
    public function we_can_fetch_a_particular_ticket()
    {
        $ticket = $this->create(\App\Ticket::class);

        $this->json('GET', $ticket->path())
            ->assertStatus(200)
            ->assertJsonFragment([
                'user_id' => $ticket->user_id,
                'customer_id' => $ticket->customer_id,
                'department_id' => $ticket->department_id,
                'support_type_id' => $ticket->support_type_id,
                'priority_id' => $ticket->priority_id,
                'subject' => $ticket->subject,
                'state' => $ticket->state,
                'name' => $ticket->owner->name,
                'name' => $ticket->customer->name,
                'name' => $ticket->department->name,
                'name' => $ticket->support_type->name,
                'name' => $ticket->priority->name
            ]);
    }

    /** @test */
    public function we_can_create_a_new_ticket()
    {
        $user = $this->create(\App\User::class);
        $customer = $this->create(\App\Customer::class);
        $department = $this->create(\App\Department::class);
        $support_type = $this->create(\App\SupportType::class);
        $priority = $this->create(\App\Priority::class);
        $subject = $this->faker->sentence;
        $state = collect(['open', 'closed'])->random();


        $this->json('POST', '/api/tickets', [
            'user_id' => $user->id,
            'customer_id' => $customer->id,
            'department_id' => $department->id,
            'support_type_id' => $support_type->id,
            'priority_id' => $priority->id,
            'subject' => $subject,
            'state' => $state,
        ])
            ->assertStatus(201)
            ->assertJsonFragment([
                'user_id' => $user->id,
                'customer_id' => $customer->id,
                'department_id' => $department->id,
                'support_type_id' => $support_type->id,
                'priority_id' => $priority->id,
                'subject' => $subject,
                'state' => $state,
            ]);
    }

    /** @test */
    public function it_validates_correctly_on_create()
    {
        $this->json('POST', '/api/tickets')
            ->assertStatus(422)
            ->assertJsonFragment(['The department id field is required.'])
            ->assertJsonFragment(['The priority id field is required.'])
            ->assertJsonFragment(['The state field is required.'])
            ->assertJsonFragment(['The subject field is required.']);
    }

    /** @test */
    public function we_can_update_a_ticket()
    {
        $ticket = $this->create(\App\Ticket::class);
        $user = $this->create(\App\User::class);
        $customer = $this->create(\App\Customer::class);
        $department = $this->create(\App\Department::class);
        $support_type = $this->create(\App\SupportType::class);
        $priority = $this->create(\App\Priority::class);
        $subject = $this->faker->sentence;
        $state = collect(['open', 'closed'])->random();

        $this->json('PATCH', $ticket->path(), [
            'user_id' => $user->id,
            'customer_id' => $customer->id,
            'department_id' => $department->id,
            'support_type_id' => $support_type->id,
            'priority_id' => $priority->id,
            'subject' => $subject,
            'state' => $state,
        ])
            ->assertStatus(200)
            ->assertJsonFragment([
                'user_id' => $user->id,
                'customer_id' => $customer->id,
                'department_id' => $department->id,
                'support_type_id' => $support_type->id,
                'priority_id' => $priority->id,
                'subject' => $subject,
                'state' => $state,
            ]);
    }

    /** @test */
    public function we_can_update_with_no_fields()
    {
        $ticket = $this->create(\App\Ticket::class);

        $this->json('PATCH', $ticket->path())
            ->assertStatus(200);
    }

    /** @test */
    public function we_can_soft_delete_a_ticket()
    {
        $ticket = $this->create(\App\Ticket::class);

        $this->json('DELETE', $ticket->path())
            ->assertStatus(200);

        $this->assertTrue($ticket->fresh()->trashed());
    }

    /** @test */
    public function we_can_fetch_deleted_support_types()
    {
        $this->create(\App\Ticket::class, [], 10);
        $ticket = \App\Ticket::first();
        $ticket->delete();

        $this->json('GET', '/api/tickets')
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $ticket->id
            ]);
    }


}
