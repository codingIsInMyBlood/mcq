<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;

class Student extends Model
{
   protected $table = "students";
   private $secretTable = "studentExamSecrets";
   

   	public function setSecret($studentId = null){
   		if($studentId == null)
        	$studentId = $this->id;
        $found = true;
        while($found){
            $secret = str_random(12);
            $found = DB::table($this->secretTable)->where("secret",$secret)->count() > 0;
        }
        DB::table($this->secretTable)->where("studentId",$studentId)->delete();
        DB::table($this->secretTable)->insert(["studentId"=>$studentId,"secret"=>$secret]);
        return $secret;
    }

    public function getSecret($id = null){
    	if($id == null)
    		$id = $this->id;
    	$s = DB::table($this->secretTable)->where("studentId",$id)->first();
    	if(!$s)
    		return null;
    	return $s->secret;
    }
}
