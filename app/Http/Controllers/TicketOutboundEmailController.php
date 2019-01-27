<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\Article;
use Illuminate\Http\Request;
use App\Http\Resources\ArticleResource;
use Illuminate\Support\Facades\Mail;
use App\Mail\ArticleOutboundEmail;

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
            
        $mail = Mail::to($article->to);
        
        if ($article->cc) {
            $mail->cc($article->cc);
        }
        
        $mail->queue(new ArticleOutboundEmail($article));

        return new ArticleResource($article);
    }

}
