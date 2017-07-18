<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpacesTable extends Migration
{
    public function up()
    {
         //Space(row, col, note, user_id ,price,date_added,avalibility)        
        Schema::create('spaces', function (Blueprint $table) {
            $table->increments('id');
			$table->string('row',10);
			$table->string('col',10);
            $table->string('note')->nullable();
            $table->decimal('price',7,2);
            $table->enum('availability', ['Reserved', 'Available', 'Not Available', 'Registered'])->default('Available'); //recheck this default - havent test by migrate yet
            $table->timestamps();
            $table->integer('user_id')->unsigned()->nullable();
            
        });
		Schema::table('spaces', function($table) {
			$table->foreign('user_id')->references('id')->on('users');
			$table->unique(['row', 'col']);
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spaces');
		
    }
}
