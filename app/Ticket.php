<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;

    protected $guarded = []; // fite me

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'customer_id' => 'integer',
        'department_id' => 'integer',
        'support_type_id' => 'integer',
        'priority_id' => 'integer',
        'status_id' => 'integer',
    ];

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

    public function status()
    {
        return $this->belongsTo(\App\Status::class);
    }

    public function articles()
    {
        return $this->hasMany(\App\Article::class);
    }

}
