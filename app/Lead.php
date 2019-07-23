<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $guarded = [];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
