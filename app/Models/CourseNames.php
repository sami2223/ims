<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseNames extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'code'];
    
    public function Courses()
    {
        return $this->hasMany(Course::class, 'course_id');
    }

    public function Batches(){
        return $this->hasManyThrough(
            Batch::class, 
            Course::class, 
            'course_id', 
            'session_id'
        );
    }
}
