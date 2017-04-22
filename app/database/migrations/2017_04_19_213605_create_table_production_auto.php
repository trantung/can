<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProductionAuto extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('production_auto', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('department_id')->nullable();
            $table->integer('warehouse_id')->nullable();
            $table->integer('product_category_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('product_loss_id')->nullable();
            $table->integer('storage_loss_id')->nullable();
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
		Schema::drop('production_auto');
	}

}
