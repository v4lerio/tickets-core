<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupportType extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function path()
    {
        return "/api/support_types/{$this->id}";
    }

}
