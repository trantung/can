<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBangCanLog extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bang_can_logs', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id_bang_can')->nullable();
            $table->integer('id_so_phieu')->nullable();
            $table->integer('id_chi_nhanh')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('session_id')->nullable();
            $table->integer('id_action')->nullable();
            $table->integer('id_status')->nullable();
            $table->integer('id_kho')->nullable();
            $table->integer('id_ma_tau')->nullable();
            $table->integer('id_kh')->nullable();
            $table->string('ten_kh')->nullable();
            $table->string('so_xe')->nullable();
            $table->string('ten_hang')->nullable();
            $table->integer('kho')->nullable();
            $table->string('ngay_can')->nullable();
            $table->integer('gio_can_lan_1')->nullable();
            $table->integer('gio_can_lan_2')->nullable();
            $table->integer('kl_tong')->nullable();
            $table->integer('kl_xe')->nullable();
            $table->integer('kl_tap_chat')->nullable();
            $table->integer('kl_hang')->nullable();
            $table->integer('luong_tru')->nullable();
            $table->integer('tap_chat')->nullable();
            $table->string('don_gia')->nullable();
            $table->integer('thanh_tien')->nullable();
            $table->string('don_vi_kl')->nullable();
            $table->string('don_vi_ty_le')->nullable();
            $table->integer('id_cty')->nullable();
            $table->string('app_id')->nullable();
            $table->integer('can_lan1')->nullable();
            $table->integer('can_lan2')->nullable();
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
		Schema::drop('bang_can_logs');
	}

}
