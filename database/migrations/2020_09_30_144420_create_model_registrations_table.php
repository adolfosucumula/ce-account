<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_registrations', function (Blueprint $table) {
            $table->increments('id_registration');
            $table->integer('people_id')->unsigned();
            $table->foreign('people_id')->references('id_people')->on('model_people');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('level')->nullable();
            $table->string('course')->nullable();
            $table->string('classe')->nullable();
            $table->string('grade')->nullable();
            $table->double('price',10,2)->nullable();
            $table->string('ticket')->nullable();
            $table->string('ticket_date')->nullable();
            $table->string('payment_method');
            $table->string('bank')->nullable();
            $table->year('academic_year');
            $table->date('date_payment');
            $table->string('month_payment');
            $table->string('day_payment');
            $table->string('signature');
            $table->string('order_code');
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
        Schema::dropIfExists('model_registrations');
    }
}
