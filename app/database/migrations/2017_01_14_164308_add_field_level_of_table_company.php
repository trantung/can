<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldLevelOfTableCompany extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('company', function(Blueprint $table) {
            $table->integer('level')->unsigned()->default(0);
            // $table->integer('parent_id')->unsigned()->default(0);
            $table->integer('lft')->nullable();
            $table->integer('rgt')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('depth')->nullable();

            // ... other fields which may feel suitable

            // Indexes
            $table->index('parent_id');
            $table->index('lft');
            $table->index('rgt');
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
