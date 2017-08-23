<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemTriggerAndSchedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		//need test
        DB::statement('SET GLOBAL event_scheduler="ON"');
		DB::statement('DROP EVENT IF EXISTS openRegister;');
		DB::statement('DROP EVENT IF EXISTS conEnd;');
		DB::statement('DROP EVENT IF EXISTS newYear;');
		DB::unprepared("
			
			CREATE EVENT `openRegister` 
				ON SCHEDULE EVERY 1 DAY STARTS '2016-08-01 00:00:01' 
				DO 
				  BEGIN
					IF CURRENT_DATE = (SELECT open_register FROM systemdate WHERE year = Year(CURRENT_DATE)) THEN
						UPDATE spaces
						SET availability = 'Available', user_id = NULL
						WHERE availability = 'Not Available';
					END IF;
				  END ;");
		DB::unprepared("
			
			CREATE EVENT `conEnd` 
				ON SCHEDULE EVERY 1 DAY STARTS '2016-08-01 00:00:01' 
				DO 
				  BEGIN
					IF CURRENT_DATE = (SELECT conference_end FROM systemdate WHERE year = Year(CURRENT_DATE)) THEN
						UPDATE spaces
						SET availability = 'Not Available';
						
					END IF;
				  END ;");
		DB::unprepared("
			
			CREATE EVENT `newYear` 
				ON SCHEDULE EVERY 1 Year STARTS '2016-01-01 00:00:01' 
				DO 
				  BEGIN
					INSERT INTO systemdate (year, open_register, conference_start, conference_end, created_at, updated_at) VALUES(year(CURRENT_DATE), ADDDATE(CURRENT_DATE, 361), ADDDATE(CURRENT_DATE, 362), ADDDATE(CURRENT_DATE, 363), CURRENT_TIMESTAMP, CURRENT_TIMESTAMP); 
				  END ;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP EVENT IF EXISTS openRegister;');
		DB::statement('DROP EVENT IF EXISTS conEnd;');
		DB::statement('DROP EVENT IF EXISTS newYear;');
    }
}
