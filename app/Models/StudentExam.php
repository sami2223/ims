<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentExam extends Model
{
    use HasFactory;
    protected $table = 'student_exam';
    protected $guarded = [];

    public function Student()
    {
        return $this->belongsTo(Student::class);
    }

    public function Course(){
        return $this->belongsTo(Course::class);
    }
}
