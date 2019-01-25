<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organisation extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'id' => 'integer',
    ];

    public function path() {
        return "/api/organisations/{$this->id}";
    }

    public function customers() {
        return $this->hasMany(Customer::class);
    }

}
