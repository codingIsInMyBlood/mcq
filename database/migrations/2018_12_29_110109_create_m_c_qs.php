<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Question;
use App\Models\Option;

class CreateMCQs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string("question");
            $table->integer("marks");
        });
        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("questionId");
            $table->string("option");
            $table->tinyInteger("isCorrect")->default(0);
        });
        // 1
        $questionId = $this->createQuestion("Which version of PHP introduced the advanced concepts of OOP?");
        $this->createOption($questionId, [
            "PHP 4",
            "PHP 5",
            "PHP 5.3",
            "PHP 6"
        ],1);

        // 2
        $questionId = $this->createQuestion("Which one of the following is the right way to clone an object?");
        $this->createOption($questionId, [
            "_clone(targetObject);",
            "destinationObject = clone targetObject;",
            "destinationObject = _clone(targetObject);",
            "destinationObject = clone(targetObject);"
        ],1);

        // 3
        $questionId = $this->createQuestion("If one intends to create a model that will be assumed by a number of closely related objects, which class must be used?");
        $this->createOption($questionId, [
            "Normal class",
            "Static class",
            "Abstract class",
            "Interface"
        ],2);

        // 4
        $questionId = $this->createQuestion("How many error levels are available in PHP?");
        $this->createOption($questionId, [
            "14",
            "15",
            "16",
            "17"
        ],2);


        // 5
        $questionId = $this->createQuestion("What is the description of Error level E_ERROR?");
        $this->createOption($questionId, [
            "Fatal run-time errorc",
            "Near-fatal error",
            "Compile-time error",
            "Fatal Compile-time error"
        ],0);

        // 6
        $questionId = $this->createQuestion("The script tag must be placed in");
        $this->createOption($questionId, [
            "head",
            "head and body",
            "title and head",
            "all of the mentioned above"
        ],1);

        // 7
        $questionId = $this->createQuestion("A JavaScript program developed on a Unix Machine");
        $this->createOption($questionId, [
            "will throw errors and exceptions",
            "must be restricted to a Unix Machine only",
            "will work perfectly well on a Windows Machine",
            "will be displayed as a JavaScript text on the browser"
        ],2);

        // 7
        $questionId = $this->createQuestion("JavaScript is ideal to");
        $this->createOption($questionId, [
            "make computations in HTML simpler",
            "minimize storage requirements on the web server",
            "increase the download time for the client",
            "none of the mentioned"
        ],1);

        // 8
        $questionId = $this->createQuestion("JavaScript can be written");
        $this->createOption($questionId, [
            "JavaScript can be written",
            "directly on the server page",
            "directly into HTML pages",
            "all of the mentioned"
        ],0);

        // 9
        $questionId = $this->createQuestion("Cookies were originally designed for");
        $this->createOption($questionId, [
            "Client-side programming",
            "Server-side programming",
            "Both Client-side & Server-side programming",
            "None of the mentioned"
        ],1);

        // 10
        $questionId = $this->createQuestion("When are the keyboard events fired?");
        $this->createOption($questionId, [
            "When user manually calls the button",
            "When user clicks a key",
            "When the user calls the modifier",
            "All of the mentioned"
        ],1);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }

    private function createQuestion($question){
        $q = new Question();
        $q->question = $question;
        $q->marks = rand(2,20);
        $q->save();
        return $q->id;
    }

    private function createOption($questionId,$options, $correct){
        foreach ($options as $k=>$option) {
            $o = new Option;
            $o->questionId = $questionId;
            $o->option = $option;
            if($k == $correct)
                $o->isCorrect = 1;
            $o->save();
        }
    }
}
