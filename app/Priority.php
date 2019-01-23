<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Priority extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'urgency' => 'integer'
    ];

    public function path()
    {
        return "/api/priorities/{$this->id}";
    }

}
