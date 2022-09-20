<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ExamType()
    {
        return $this->belongsTo(ExamType::class);
    }

    public function Students()
    {
        //return $this->belongsToMany(RelatedModel, pivot_table_name, foreign_key_of_current_model_in_pivot_table, foreign_key_of_other_model_in_pivot_table);
        return $this->belongsToMany(
            Student::class,
            'student_exam',
            'exam_id',
            'student_id'           
        );
    }

    public function CourseName()
    {
        return $this->belongsTo(CourseNames::class, 'course_id');
    }

    public function Teacher()
    {
        return $this->belongsTo(Employee::class, Course::class);
    }

    public function Course()
    {
        return $this->belongsTo(Course::class, 'session_id');
    }
    public function Shift()
    {
        return $this->belongsTo(Shift::class);
    }
    
}
