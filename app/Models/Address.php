<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'father_contact',
        'address_one',
        'address_two',
        'city',
        'state',
        'pin_code',
        'country',
        'phone',
        'officePhone',
        'mobile',
        'email'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
