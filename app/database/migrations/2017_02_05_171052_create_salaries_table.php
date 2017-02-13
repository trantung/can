<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalariesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('salaries', function(Blueprint $table) {
            $table->increments('id');
            $table->double('total')->nullable();
            $table->string('description', 255)->nullable();
            $table->date('pay_time');
            $table->tinyInteger('ngay_cong');
            $table->tinyInteger('ngay_di_lam');
            $table->double('luong_trach_nhiem');
            $table->double('phu_cap');
            $table->tinyInteger('kieu_luong');
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
		Schema::drop('salaries');
	}

}
