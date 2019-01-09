<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function path() {
        return "/api/customers/{$this->id}";
    }

    public function Organisation() {
        return $this->belongsTo(Organisation::class);
    }
}
