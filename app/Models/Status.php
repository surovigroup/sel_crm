<?php

namespace App;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $guarded = [];

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
}
