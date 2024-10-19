<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['lesson_id', 'title', 'description', 'time_limit', 'number_of_items'];

    public function questions()
    {
        return $this->hasMany(Question::class)->limit($this->number_of_items);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
