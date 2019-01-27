<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\Article;
use Illuminate\Http\Request;
use App\Http\Resources\ArticleResource;

class TicketOutboundEmailController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Ticket $ticket)
    {
        $data = $request->validate([
            'from' => 'required|email',
            'to' => 'required|email',
            'cc' => 'sometimes|required|email',
            'subject' => 'required',
            'body' => 'required'
        ]);

        $data['type'] = 'outbound_email';
        $data['user_id'] = \Auth::user()->id;

        $article = $ticket->articles()->create($data);

        return new ArticleResource($article);
    }

}
