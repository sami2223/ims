<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentParent extends Model
{
    use HasFactory;

    protected $table = 'parents';
    protected $primaryKey = 'id';
    protected $fillable = [
        'student_id',
        'first_name',
        'last_name',
        'dob',
        'relation',
        'education',
        'occupation',
        'income',
        'image',
        'contact'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function emergency_contact()
    {
        return $this->hasOne(EmergencyContact::class, 'parent_id');
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
