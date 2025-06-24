<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tablet extends Model
{
    use HasFactory;
    protected $guarded =['id'];
    protected $fillable =['name','email','password','hashedPassword'];


    public function getAdvertisement(){
        return $this->hasMany(Advertisement::class,'tab_Id','id');
    }

}
