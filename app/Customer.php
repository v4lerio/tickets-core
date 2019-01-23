<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function path() 
    {
        return "/api/customers/{$this->id}";
    }

    public function organisation() 
    {
        return $this->belongsTo(Organisation::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

}
