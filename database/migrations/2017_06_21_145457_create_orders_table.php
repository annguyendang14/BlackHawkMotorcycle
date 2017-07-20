<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Order(order_id, user_id, payment_type, status, total_price, unpaid_price)
			-total_price : calculate using OrderLine table, maybe using view for it
			-status: pending, void, authorized, ready_for_shipment, enroute, paid, confirmed, refunded, payment_declined, shipped, archived, awaiting_payment, partial_payment, cancelled */        
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('paymentType',20);
            $table->enum('status',['pending', 'void', 'authorized', 'ready_for_shipment', 'enroute', 'paid', 'confirmed', 'refunded', 'payment_declined', 'shipped', 'archived', 'awaiting_payment', 'partial_payment', 'cancelled']);
            $table->decimal('total_price',15,2);
            $table->decimal('unpaid_price',15,2);
            $table->integer('user_id')->unsigned();
			$table->timestamps();
            
        });
		Schema::table('orders', function($table) {
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('paymentType')->references('paymentType')->on('paymentTypes');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
