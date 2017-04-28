<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCanKiemDinh extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('can_kiem_dinh', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id_bang_can')->nullable();
            $table->integer('id_so_phieu')->nullable();
            $table->integer('id_chi_nhanh')->nullable();
            $table->string('app_id')->nullable();
            $table->integer('id_bang_kd')->nullable();
            $table->integer('id_ma_tau')->nullable();
            $table->integer('kl_tong')->nullable();
            $table->integer('kl_xe')->nullable();
            $table->integer('kl_hang')->nullable();
            $table->integer('ty_le_mun')->nullable();
            $table->integer('ty_le_qua_co')->nullable();
            $table->integer('ty_le_vo')->nullable();
            $table->integer('ty_le_tap_chat')->nullable();
            $table->string('id_status')->nullable();
            $table->integer('type')->nullable();
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
		Schema::drop('can_kiem_dinh');
	}

}
