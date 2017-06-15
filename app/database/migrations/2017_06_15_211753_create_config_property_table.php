<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigPropertyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('config_properties', function(Blueprint $table) {
            $table->increments('id');
            $table->string('model_name', 255)->nullable();
            $table->integer('model_id')->nullable();
            $table->integer('warehouse_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->string('data')->nullable();
            $table->integer('status')->nullable();
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
		Schema::drop('config_properties');
	}

}
