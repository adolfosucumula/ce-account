<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_students', function (Blueprint $table) {
            $table->increments('id_student');
            $table->string('code_student');
            $table->integer('people_id')->unsigned();
            $table->foreign('people_id')->references('id_people')->on('model_people')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('class_id')->unsigned();
            $table->foreign('class_id')->references('id_class')->on('model_classes');
            $table->string('state');
            $table->string('academic_year');
            $table->integer('contact_id')->unsigned();
            $table->foreign('contact_id')->references('id_contact')->on('model_contacts');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('model_students');
    }
}
