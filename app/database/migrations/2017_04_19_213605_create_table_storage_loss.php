<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStorageLoss extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('storage_loss', function(Blueprint $table) {
            $table->increments('id');
            $table->string('model_name', 255)->nullable();
            $table->integer('model_id')->nullable();
            $table->integer('warehouse_id')->nullable();
            $table->integer('ratio')->nullable();
            $table->integer('active')->nullable();
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
		Schema::drop('storage_loss');
	}

}
