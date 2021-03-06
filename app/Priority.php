<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Priority extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'id' => 'integer',
        'urgency' => 'integer'
    ];

    public function path()
    {
        return "/api/priorities/{$this->id}";
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

}
