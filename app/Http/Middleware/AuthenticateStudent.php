<?php

namespace App\Http\Middleware;

use CustomException;
use Closure;
use CustomData;
use DB;
use App\Models\Student;
use App\Models\StudentReport;

class AuthenticateStudent
{
    private $studentId;
    private $secretTable = "studentExamSecrets";

    public function handle($request, Closure $next)
    {

        if($request->is("api/refresh") || $request->is("api/student/results") || ($request->is("api/student") && $request->method() == "POST") ){
            if($request->hasHeader("secret") && !empty($request->header("secret"))){
                $this->decryptSecret($request->header("secret"));
                $this->invalidateSecret();
            }
            return $next($request);
        }
        if( !$request->hasHeader("secret") || empty($request->header("secret")) )
            return response()->json(["error"=>"Bad Request"],400);
        else
            $this->decryptSecret($request->header("secret"));

        $student = new Student();

        return $next($request)->withHeaders(["secret"=>$student->setSecret($this->studentId)]);
    }

    private function decryptSecret($secret){
        $f = DB::table($this->secretTable)->where("secret",$secret)->first();
        if(!$f)
            throw new CustomException("Authentication failed", 1);
        $this->studentId = $f->studentId;
        CustomData::set("studentId",$f->studentId);  
    }

    private  function invalidateSecret(){
        // throw new CustomException("studentId".$this->studentId, 1);
        
        DB::table($this->secretTable)->where("studentId",$this->studentId)->delete();
        $sr = StudentReport::where("studentId",$this->studentId)->first();
        if(!$sr)
            return;
        $sr->status = -1;
        $sr->save();
    }

    
}
