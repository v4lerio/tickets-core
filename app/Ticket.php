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

    public function owner() 
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    public function customer()
    {
        return $this->belongsTo(\App\Customer::class);
    }

    public function department()
    {
        return $this->belongsTo(\App\Department::class);
    }

    public function support_type()
    {
        return $this->belongsTo(\App\SupportType::class);
    }

    public function priority()
    {
        return $this->belongsTo(\App\Priority::class);
    }

}
