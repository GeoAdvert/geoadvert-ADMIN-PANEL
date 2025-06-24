<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewAdvertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'advertisment_id',
        'views',
    ];
}
