<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreFieldLogScale extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('scale_rate', function(Blueprint $table) {
            $table->string('doi_tac_ten', 255)->nullable();
            $table->string('doi_tac_sdt', 255)->nullable();
            $table->text('doi_tac_dia_chi')->nullable();
            $table->string('doi_tac_fax', 255)->nullable();
            $table->integer('partner_id')->nullable();
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
