<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;

    protected $guarded = []; // fite me

    public function path() 
    {
        return "/api/tickets/{$this->id}";
    }
}
