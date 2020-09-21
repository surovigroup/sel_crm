<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Devfaysal\LaravelAdmin\Models\Admin;

class Lead extends Model
{
    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime'
    ];

    protected $with = ['status', 'createdBy'];

    public function asignedTo()
    {
        return $this->belongsTo(Admin::class, 'admin_assigned_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'admin_created_id');
    }
}
