<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\StudentExamSecret;
use Illuminate\Http\Request;
use CustomData;
use App\Models\StudentReport;

class StudentController extends Controller
{
   	public function create(Request $request){
   		$this->validate($request, [
   			"name"=>"required|max:100"
   		]);

   		$student = new Student();
   		$student->name = $request->name;
   		$student->save();
   		$secret = $student->setSecret();
         $sr = new StudentReport();
         $sr->studentId = $student->id;
         $sr->result = $sr->status = 0;
         $sr->save();
   		return response()->json(["success"=>true])->withHeaders([
   			"secret"=>$secret
   		]);
   	}
      
      public function complete(Request $request){
         $sr = StudentReport::where("studentId",CustomData::get("studentId"))->first();
         if(!$sr)
            throw new CustomException("Report was not generated", 1);
         
         $sr->status = 1;
         $sr->save();
         return response()->json(["score"=>$sr->result]);  
      }

   public function results(Request $request){
      $sr = StudentReport::with("student")->get();
      return response()->json(["results"=>$sr]);
   }
}
