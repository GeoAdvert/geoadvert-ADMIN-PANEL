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
        'is_first'
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
