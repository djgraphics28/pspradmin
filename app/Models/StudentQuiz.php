<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentQuiz extends Model
{
    use HasFactory;

    // Specify the fillable properties
    protected $fillable = [
        'student_id',
        'quiz_id',
        'score',
        'total_questions',
        'time_taken',
        'status',
        'remarks',
        'quiz_data'
    ];

    // Optionally, you can define relationships if needed
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
