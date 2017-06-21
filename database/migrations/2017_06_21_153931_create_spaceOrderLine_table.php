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
			$table->integer('order_id')->unsigned();
            $table->string('row',10);
			$table->string('col',10);
            $table->decimal('price',7,2);
            $table->timestamps();
            
        });
		Schema::table('spaceOrderLine', function($table) {
			$table->foreign('order_id')->references('id')->on('orders');
			$table->foreign('row')->references('row')->on('spaces');
			//$table->foreign('col')->references('col')->on('spaces'); not sure why not work, but it might not affect the database
			$table->primary(array('order_id','row', 'col'));
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
