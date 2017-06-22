<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpaceOrderLineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           
        Schema::create('spaceOrderLine', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('order_id')->unsigned();
            $table->integer('space_id')->unsigned();
            $table->decimal('price',7,2);
            $table->timestamps();
            
        });
		Schema::table('spaceOrderLine', function($table) {
			$table->foreign('order_id')->references('id')->on('orders');
			$table->foreign('space_id')->references('id')->on('spaces');
			$table->unique(['order_id','space_id']);
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spaceOrderLine');
		
    }
}
