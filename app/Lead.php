<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $guarded = [];

    protected $with = ['status', 'createdBy'];

    public function asignedTo()
    {
        return $this->belongsTo(User::class, 'user_assigned_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_created_id');
    }
}
