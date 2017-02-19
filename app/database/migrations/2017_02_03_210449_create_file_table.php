<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('files', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->nullable();
            $table->string('link', 255)->nullable();
            $table->string('model', 255)->default('attach');
            $table->integer('model_id')->default(NULL)->unsigned();
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
		Schema::drop('files');
	}

}
