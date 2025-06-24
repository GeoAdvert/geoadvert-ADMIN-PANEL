<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','advertisement_id','stripe_session_id','status','purchasing_status'];

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class);
    }
}
