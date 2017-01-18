<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('personal_info', function(Blueprint $table) {
            $table->increments('id');
            $table->string('ma_nv', 255)->nullable();
            $table->string('ho_ten', 255)->nullable();
            $table->string('ten_thuong_goi', 255)->nullable();

            $table->string('image', 255)->nullable();

            $table->enum('gioi_tinh', array('M', 'F', 'O'))->default('M');
            $table->date('nam_sinh')->nullable();
            $table->integer('noi_sinh')->nullable()->unsigned();

            $table->integer('cmt')->nullable()->unique()->unsigned();
            $table->date('ngay_cap')->nullable();
            $table->integer('noi_cap')->nullable()->unsigned();

            $table->string('dia_chi_thuong_tru', 255)->nullable();
            $table->string('dia_chi_tam_tru', 255)->nullable();

            $table->integer('mobile')->nullable()->unique();

            $table->string('email', 255)->nullable()->unique();

            $table->integer('dan_toc')->nullable()->unsigned();
            $table->integer('ton_giao')->nullable()->unsigned();
            $table->integer('quoc_tich')->nullable()->unsigned();
            $table->integer('ho_chieu')->nullable()->unique()->unsigned();
            $table->date('ngay_cap_ho_chieu')->nullable();
            $table->string('noi_cap_ho_chieu', 255)->nullable()->unique();


            $table->enum('tinh_trang_hon_nhan',  array('Y', 'N', 'O'))->default('O');
            $table->integer('ma_so_thue')->nullable()->unique()->unsigned();
            $table->date('ngay_cap_mst')->nullable();
            $table->string('so_tai_khoan', 255)->nullable();
            $table->string('ngan_hang', 255)->nullable();
            $table->string('nguyen_quan', 255)->nullable();

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
		Schema::drop('personal_info');
	}

}
