<?php

namespace App\Http\Controllers;
use App\Models\Question;
use Illuminate\Http\Request;
use CustomException;
use App\Models\StudentReport;
use CustomData;

class MCQController extends Controller
{
	public function getAll(Request $request){
		$questions = Question::with(["options"])->get();
      $questions = $questions->shuffle();
      $questions = $questions->toArray();
      foreach ($questions as $k=>$question) {
         $questions[$k]["options"] = collect($question["options"])->shuffle();
      }
      return response()->json(["data"=>$questions]);
	}

   public function check(Request $request){
      $this->validate($request, [
         "questionId"=>"required|integer",
         "optionId"=>"required|integer"
      ]);

      $question = Question::find($request->questionId);
      if(!$question)
         throw new CustomException("Question not found",1);

      if($question->options()->where("id",$request->optionId)->where("isCorrect",1)->count() < 1){
         $msg = "Incorrect Answer.\nAnswer is ".$question->options()->where("isCorrect",1)->first()->option;
         throw new CustomException($msg, 1);
      }
      StudentReport::where("studentId",CustomData::get("studentId"))->increment("result",1);
      return response()->json(["success"=>true]);  
   }
}
