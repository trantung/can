<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableScaleStation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('scale_stations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('department_id')->nullable();
            $table->integer('app_id')->nullable();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->integer('max_coupon')->nullable();
            $table->integer('type')->nullable();
            $table->integer('status')->nullable();
            $table->integer('created_by')->nullable()->unsigned();
            $table->integer('updated_by')->nullable()->unsigned();
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
		Schema::drop('scale_stations');
	}

}
