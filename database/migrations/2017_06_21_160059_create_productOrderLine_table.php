<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductOrderLineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
              
        Schema::create('productOrderLine', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('order_id')->unsigned();		
			$table->string('product_id',20);
			$table->integer('quantity') ;
            $table->decimal('price',7,2);	
			$table->integer('address_id')->unsigned();	
            $table->timestamps();
            
        });
		Schema::table('productOrderLine', function($table) {
			$table->foreign('order_id')->references('id')->on('orders');
			$table->foreign('address_id')->references('id')->on('addresses');
			$table->foreign('product_id')->references('id')->on('products');
			$table->unique(['order_id','product_id']);
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productOrderLine');
		
    }
}
