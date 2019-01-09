<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function path()
    {
        return "/api/departments/{$this->id}";
    }

    public function manager() {
        return $this->belongsTo(User::class);
    }

}
