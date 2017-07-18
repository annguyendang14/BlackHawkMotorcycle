<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateSystemDateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systemDate', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('year')->unsigned()->unique();		
			$table->date('open_register');
			$table->date('conference_start');
            $table->date('conference_end');
            $table->timestamps();
            
        });
		/* DB::statement('ALTER TABLE systemDate ADD CONSTRAINT chk_date CHECK (open_register < conference_start AND conference_start < conference_end);'); */
    }
		
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('systemDate');
    }
}
