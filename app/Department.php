<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'id' => 'integer',
        'manager_id' => 'integer',
    ];

    public function path()
    {
        return "/api/departments/{$this->id}";
    }

    public function manager() {
        return $this->belongsTo(User::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

}
