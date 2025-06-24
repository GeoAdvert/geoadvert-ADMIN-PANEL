<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Quiz extends Model
{
    protected $appends = ['image_url'];

    use HasFactory;
    protected $fillable = [
        "question",
        "image"
    ];

    public function answers(){
        return $this->hasMany(QuizAns::class);
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? URL::to($this->image) : null;
    }
}
