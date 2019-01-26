<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{

    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'id' => 'integer',
        'ticket_id' => 'integer',
        'ticket_id' => 'user_id',
    ];

    public function ticket()
    {
        return $this->belongsTo(\App\Ticket::class);
    }

}
