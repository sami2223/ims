<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function CreatedBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function UpdatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
