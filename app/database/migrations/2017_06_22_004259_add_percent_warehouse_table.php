<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPercentWarehouseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('percent_warehouse', function(Blueprint $table) {
            $table->string('ty_le_mun', 255)->nullable();
            $table->string('ty_le_qua_co', 255)->nullable();
            $table->string('ty_le_vo', 255)->nullable();
            $table->string('ty_le_tap_chat', 255)->nullable();
            $table->string('do_kho', 255)->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
