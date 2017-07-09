<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('partners', function(Blueprint $table) {
            $table->increments('id');
            $table->string('doi_tac_ten', 255)->nullable();
            $table->string('doi_tac_sdt')->nullable();
            $table->text('doi_tac_dia_chi')->nullable();
            $table->string('doi_tac_fax')->nullable();
            $table->integer('partner_id')->nullable();
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
		Schema::drop('partners');
	}

}
