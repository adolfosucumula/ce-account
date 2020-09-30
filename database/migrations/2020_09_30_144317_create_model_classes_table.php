<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_classes', function (Blueprint $table) {
            $table->increments('id_class');
            $table->string('class');
            $table->string('period');
            $table->string('room');
            $table->integer('course_id')->nullable()->unsigned();
            $table->foreign('course_id')->references('id_course')->on('model_courses');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id_category')->on('model_category_courses');
            $table->integer('grade_id')->unsigned();
            $table->foreign('grade_id')->references('id_grade')->on('model_grades')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('model_classes');
    }
}
