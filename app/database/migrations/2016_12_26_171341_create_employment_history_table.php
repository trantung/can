<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmploymentHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employment_history', function(Blueprint $table) {
            $table->increments('id');
            $table->string('why_out', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->integer('company_name')->nullable()->unsigned();
            $table->integer('branch')->nullable()->unsigned();
            $table->integer('position')->nullable()->unsigned();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('created_by')->nullable()->unsigned();
            $table->integer('personal_id')->nullable()->unsigned();
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
		Schema::drop('employment_history');
	}

}
