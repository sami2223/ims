<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';
    protected $primaryKey = 'id';    
    public $timestamps = 'true';
    protected $fillable = ['course', 'duration', 'start_date', 'end_date', 'teacher_id', 'course_id'];

    public function Batches(){        
        return $this->hasMany(Batch::class, 'session_id');
    }

    public function StudentExam(){
        return $this->hasMany(StudentExam::class);
    }

    // public function sessions(){        
    //     return $this->hasMany(Session::class);
    // }

    public function students(){        
        return $this->hasMany(Student::class);
    }
    

    public function teacher(){        
        return $this->belongsTo(Employee::class,'teacher_id');
    }

    public function CourseName(){        
        return $this->belongsTo(CourseNames::class, 'course_id');
    }


    public function Exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function AddFeeAmount()
    {
        return $this->hasMany(AddFee::class, 'course_id');
    }

    // public function engines(){
    //     return $this->hasManyThrough(
    //         Engine::class,
    //         CarModel::class,
    //         'car_id', //foreign key of car table in carModel table
    //         'model_id' //foreign key of carModel table in engine table
    // );
    // }
}
