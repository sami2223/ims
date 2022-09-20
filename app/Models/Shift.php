<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    protected $fillable = ['shift_name'];

    public function Exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function Batches(){
        return $this->hasMany(Batch::class);
    }

    public function Students(){
        return $this->hasMany(Student::class);
    }
}
