<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\Article;
use Illuminate\Http\Request;
use App\Http\Resources\ArticleResource;

class TicketInternalNoteController extends Controller
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
            'subject' => 'required',
            'body' => 'required'
        ]);

        $data['type'] = 'internal_note';
        $data['user_id'] = \Auth::user()->id;

        $article = $ticket->articles()->create($data);

        return new ArticleResource($article);
    }

}
