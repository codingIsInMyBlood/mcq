<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class StudentReport extends Model
{
   protected $table = "studentReports";

   public function student(){
   	return $this->hasOne("App\Models\Student","id","studentId");
   }
}
