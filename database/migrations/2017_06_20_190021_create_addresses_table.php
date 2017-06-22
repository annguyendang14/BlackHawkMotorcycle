<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
                
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('addr1');
            $table->string('addr2')->nullable();
            $table->string('city');
            $table->string('state');
			$table->string('country')->default('USA');
            $table->string('postalCode')->nullable();
            $table->boolean('prefered')->default(False);
            $table->integer('user_id')->unsigned();
			$table->timestamps();
            
        });
		Schema::table('addresses', function($table) {
			$table->foreign('user_id')->references('id')->on('users');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
		Schema::dropIfExists('addressTypes');
    }
}
