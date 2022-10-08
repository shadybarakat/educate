<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categories_course extends Model
{
    public $fillable=array('course_id','category_id');

    public function category(){
        return $this->belongsTo('App\category');
    }

    public function course(){
        return $this->belongsTo('App\course');
    }
}
