<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $primaryKey = 'id';    
    public $timestamps = 'true';
    protected $fillable = [
        'reg_no',
        'first_name',   
        'last_name',
        'father_name',
        'dob',
        'gender',
        'bloodgroup',
        'address',
        'city',
        'religion',
        'nationality',
        'mobile',
        'biometric_id',
        'email',
        'father_contact',
        'course_id',
        'session_id',
        'batch_id',
        'shift_id',
        'yoj',
        'yol',
        'image',
        'code'
    ];

    public function Batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function Timing()
    {
        return $this->hasOne(Timing::class);
    }

    public function Feedback()
    {
        return $this->hasOne(StudentFeedback::class);
    }

    public function Course()
    {
        return $this->belongsTo(Course::class, 'session_id');
    }

    public function Session()
    {
        return $this->belongsTo(Session::class);
    }

    public function Shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function Address()
    {
        return $this->hasOne(Address::class, 'student_id');
    }

    public function StdPreviousData()
    {
        return $this->hasOne(StdPreviousData::class);
    }

    public function FeeSlips()
    {
        return $this->hasMany(FeeSlip::class);
    }
    
    public function Fees()
    {
        return $this->hasManyThrough(Fee::class, FeeSlip::class, 'student_id','slip_id');
    }

    public function Exams()
    {
        //return $this->belongsToMany(RelatedModel, pivot_table_name, foreign_key_of_current_model_in_pivot_table, foreign_key_of_other_model_in_pivot_table);
        return $this->belongsToMany(
            Exam::class,
            'student_exam',
            'student_id',
            'exam_id'          
        );
    }

    public function StudentExam(){
        return $this->hasMany(StudentExam::class);
    }

    public function Certificate(){
        return $this->hasOne(Certificates::class);
    }

}
