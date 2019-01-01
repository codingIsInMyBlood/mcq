<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentReports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("studentId")->index();
            $table->integer("result");
            $table->tinyInteger("status")->comment("0-Incomplete,1-Complete");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('studentReports');
    }
}
