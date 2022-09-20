<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{
    use HasFactory;
    protected $table = 'emergency_contacts';
    protected $primaryKey = 'id';

    protected $fillable = [
        'std_id',
        'parent_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function parent()
    {
        return $this->hasOne(StudentParent::class, 'std_id', 'std_id');
    }
}
