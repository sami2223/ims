<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Batch extends Model
{
    use HasFactory;

    protected $table = 'batches';

    protected $primaryKey = 'id';
    
    public $timestamps = 'true';

    protected $fillable = [
        'session_id', 
        'batch_name',
        'shift_id',
        'sh_title'
    ];

    public function Students(){
        return $this->hasMany(Student::class);
    }

    public function CourseNames(){
        return $this->belongsTo(CourseNames::class, 'session_id');
    }

    public function Course()
    {
        return $this->belongsTo(Course::class, 'session_id');
    }

    public function Shift(){
        return $this->belongsTo(Shift::class);
    }
    
}
