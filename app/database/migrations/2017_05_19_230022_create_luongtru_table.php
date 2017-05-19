<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLuongtruTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('luongtru_maphieu_can', function(Blueprint $table) {
            $table->increments('id');
            $table->string('ma_cd')->nullable();
            $table->string('ma_phieu_can')->nullable();
            $table->string('luongtru')->nullable();
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
		Schema::drop('luongtru_maphieu_can');
	}

}
