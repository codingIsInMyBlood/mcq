<?php

use Illuminate\Http\Request;

Route::middleware("studentAuth")->group(function(){
	Route::get("refresh",function(){
		return response()->json(["success"=>true]);
	});
	Route::prefix("student")->group(function(){
		Route::post("","StudentController@create");
		Route::post("complete","StudentController@complete");
		Route::get("results","StudentController@results");
	});
	Route::prefix("mcq")->group(function(){
		Route::get("","MCQController@getAll");
		Route::post("check","MCQController@check");
	});
});
	
