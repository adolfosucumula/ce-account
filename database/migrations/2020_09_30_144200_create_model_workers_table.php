<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_workers', function (Blueprint $table) {
            $table->increments('id_worker');
            $table->string('category');
            $table->integer('people_id')->unsigned();
            $table->foreign('people_id')->references('id_people')->on('model_people')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('contact_id')->unsigned();
            $table->foreign('contact_id')->references('id_contact')->on('model_contacts');
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
        Schema::dropIfExists('model_workers');
    }
}
