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

    public function parent()
    {
        return $this->belongsTo(SupportType::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(SupportType::class, 'parent_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

}
