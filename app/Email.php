<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'id' => 'integer',
        'priority_id' => 'integer',
        'department_id' => 'integer',
    ];

    public function path()
    {
        return "/api/emails/{$this->id}";
    }
    
}
