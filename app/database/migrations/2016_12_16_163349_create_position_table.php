<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
    {
        Schema::create('positions', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->nullable();
            $table->mediumText('description')->nullable();
            $table->integer('branch_category_id')->unsigned()->nullable();
            $table->integer('company_category_id')->unsigned()->nullable();
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
        Schema::drop('positions');
    }

}
