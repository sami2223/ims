<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    protected $fillable = ['session_name', 'course_id'];

    public function batches()
    {
        return $this->hasMany(Batch::class);

    }

    public function Exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
