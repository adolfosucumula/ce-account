<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_people', function (Blueprint $table) {
            $table->increments('id_people');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('gender')->default('M');
            $table->string('m_state')->default('Single');
            $table->string('nationality')->nullable()->default('');
            $table->string('description')->nullable()->default('');
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id_city')->on('model_cities')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('identity_code')->unsigned();
            $table->foreign('identity_code')->references('id_identity')->on('model_identities')->onDelete('cascade')->onUpdate('cascade');
            $table->string('parents')->nullable()->default(''); 
            $table->string('photo')->nullable()->default('photo.png'); 
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
        Schema::dropIfExists('model_people');
    }
}
