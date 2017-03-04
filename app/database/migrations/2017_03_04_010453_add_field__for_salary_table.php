<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldForSalaryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('salaries', function(Blueprint $table) {
            $table->double('thuong_le_tet', 15,4);
            $table->double('tong_giam_tru', 15,4);
            $table->double('tien_dien_thoai', 15,4);
            $table->double('thuc_linh', 15,4);
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
