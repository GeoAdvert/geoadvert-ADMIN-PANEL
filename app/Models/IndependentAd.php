<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndependentAd extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_quiz',
        'quiz_time',
    ];
}
