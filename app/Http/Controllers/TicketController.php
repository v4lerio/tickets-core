<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;
use App\Http\Resources\TicketResource;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TicketResource::collection(Ticket::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'sometimes|integer|exists:users,id',
            'customer_id' => 'sometimes|integer|exists:customers,id',
            'department_id' => 'required|integer|exists:departments,id',
            'support_type_id' => 'sometimes|integer|exists:support_types,id',
            'priority_id' => 'required|integer|exists:priorities,id',
            'subject' => 'required',
            'state' => 'required|in:open,closed'
        ]);

        $ticket = Ticket::create($data);

        return new TicketResource($ticket);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return new TicketResource($ticket->load([
            'owner',
            'customer',
            'department',
            'support_type',
            'priority'
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $data = $request->validate([
            'user_id' => 'sometimes|integer|exists:users,id',
            'customer_id' => 'sometimes|integer|exists:customers,id',
            'department_id' => 'sometimes|required|integer|exists:departments,id',
            'support_type_id' => 'sometimes|sometimes|integer|exists:support_types,id',
            'priority_id' => 'sometimes|required|integer|exists:priorities,id',
            'subject' => 'sometimes|required',
            'state' => 'sometimes|required|in:open,closed'
        ]);

        $ticket->update($data);

        return new TicketResource($ticket);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
    }
}
