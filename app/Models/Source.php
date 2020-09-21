<?php

namespace App;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $guarded = [];

    public function leads(): Collection
    {
        return Lead::where('source', $this->name)->get();
    }
}
