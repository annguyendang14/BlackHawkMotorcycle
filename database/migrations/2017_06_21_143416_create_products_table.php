<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Products(product_id, description, price, in stock)
        Schema::create('products', function (Blueprint $table) {
            
            $table->string('id',20);
            $table->decimal('price',7,2);
            $table->string('description');
            $table->timestamps();
            $table->integer('in stock')->unsigned();
            
        });
		Schema::table('products', function($table) {
			
			$table->primary('id');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
		
    }
}
