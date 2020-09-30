<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelAccessPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_access_pages', function (Blueprint $table) {
            $table->increments('id_access');
            $table->integer('page_id')->unsigned();
            $table->foreign('page_id')->references('id_page')->on('model_pages');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('allowed')->default(0);
            $table->enum('insert_', ['1', '0'])->default(0);
            $table->enum('update_', ['1', '0'])->default(0);
            $table->enum('delete_', ['1', '0'])->default(0);
            $table->enum('select_', ['1', '0'])->default(1);
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
        Schema::dropIfExists('model_access_pages');
    }
}
