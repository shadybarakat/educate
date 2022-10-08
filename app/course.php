<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    public $fillable=array('name',
    'Rating',
    'Lectures',
    'Duration',
    'level',
    'Language',
    'price',
    'description',
    'instructor_id',
    'image',);

    public function instructor(){
        return $this->belongsTo('App\user');
    }
}
