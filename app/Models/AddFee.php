<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddFee extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function Feetype()
    {
        return $this->belongsTo(FeeType::class, 'feetype_id');
    }
}
