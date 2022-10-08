<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    public $fillable=array('course_id','user_id');

    public function course(){
        return $this->belongsTo('App\course');
    }
}
