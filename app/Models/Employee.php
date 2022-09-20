<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_name',
        'designation_id',
        'email',   
        'sal_type',   
        'sal_amount',   
    ];

    public function Designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function Courses()
    {
        return $this->hasMany(Course::class);
    }
    public function Exams()
    {
        return $this->hasManyThrough(Exam::class, Course::class);
    }

    public function Salaries()
    {
        return $this->hasMany(Salary::class, 'employee_id');
    }
    
}
