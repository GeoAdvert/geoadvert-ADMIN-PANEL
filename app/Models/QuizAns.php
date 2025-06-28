<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAns extends Model
{
    use HasFactory;
    protected $fillable = [
        'quiz_id',
        'advertisement_id',
        'ans',
        'is_first',
        'is_correct'
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
