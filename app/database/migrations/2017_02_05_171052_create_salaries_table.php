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
            $table->double('total', 15,4)->nullable()->unsigned();
            $table->mediumText('description')->nullable();
            $table->date('pay_time');
            $table->double('ngay_cong', 3,1);
            $table->double('ngay_di_lam', 3,1);
            $table->double('month');
            $table->string('year',4);
            $table->double('luong_trach_nhiem', 3,1);
            $table->double('phu_cap', 3,1);
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
