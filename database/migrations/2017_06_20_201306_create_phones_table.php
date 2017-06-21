<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Phone(number, phone_type, prefered, user_id)
		Schema::create('phone', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number',20);
            $table->string('phoneType',20);
            $table->boolean('prefered');
            $table->integer('user_id')->unsigned();
			$table->timestamps();
            
        });
		Schema::table('phone', function($table) {
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('phoneType')->references('phoneType')->on('phoneTypes');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phone');
    }
}
