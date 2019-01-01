<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
   protected $table = "questions";

   public $timestamps = false;

   public function options(){
   	return $this->hasMany("App\Models\Option","questionId","id");
   }
}
