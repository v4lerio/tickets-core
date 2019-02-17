<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'id' => 'integer',
    ];

    public static $state_types = [
        'open',
        'closed',
        'archived'
    ];

    public function path()
    {
        return "/api/statuses/{$this->id}";
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
