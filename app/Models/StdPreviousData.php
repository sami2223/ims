<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StdPreviousData extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'education',
        'computer_knowledge'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
