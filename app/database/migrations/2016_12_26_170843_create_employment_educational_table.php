<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmploymentEducationalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employment_educational', function(Blueprint $table) {
            $table->increments('id');
            $table->string('school_name', 256)->nullable();
            $table->integer('industry_id')->nullable()->unsigned();
            $table->integer('certificate_id')->nullable()->unsigned();
            $table->integer('personal_id')->nullable()->unsigned();
            $table->date('graduation_year')->nullable();
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
		Schema::drop('employment_educational');
	}

}
