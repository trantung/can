<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePercentWarehouseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('percent_warehouse', function(Blueprint $table) {
            $table->increments('id');
            $table->string('model_name', 255)->nullable();
            $table->integer('model_id')->nullable();
            $table->integer('warehouse_id')->nullable();
            $table->string('tilekho')->nullable();
            $table->string('tilemun')->nullable();
            $table->string('tilequaco')->nullable();
            $table->string('doam')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('percent_warehouse');
	}

}
