<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;
    protected $guarded =['id'];
    protected $fillable =['tab_Id','radius','videoDuration','locationBased','latitude','longitude','status','fileType','start_time','end_time','fileName','tag','views','display_frequency','type'];

    public function tablet()
    {
        return $this->belongsTo(User::class, 'tab_Id', 'id');
    }

    public function advertisementView(){
        return $this->hasMany(ViewAdvertisement::class , 'advertisment_id' , 'id');
    }

    public function quizAns()
    {
        return $this->hasMany(QuizAns::class, 'advertisement_id');
    }

}
