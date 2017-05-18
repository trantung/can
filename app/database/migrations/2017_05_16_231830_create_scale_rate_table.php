<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScaleRateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('scale_rate', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('number_ticket')->nullable();
            $table->string('number_car')->nullable();
            $table->string('category_id')->nullable();
            $table->string('transfer_type')->nullable();
            $table->integer('warehouse_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->string('campaign_name')->nullable();
            $table->string('campaign_method')->nullable();
            $table->string('campaign_code')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_address')->nullable();
            $table->string('customer_fax')->nullable();
            $table->string('scale_at')->nullable();
            $table->string('first_scale_hour')->nullable();
            $table->string('second_scale_hour')->nullable();
            $table->string('first_scale_weight')->nullable();
            $table->string('second_scale_weight')->nullable();
            $table->string('package_weight')->nullable();
            $table->string('app_id', 256)->nullable();
            $table->string('code')->nullable();
            $table->integer('type')->nullable();
            $table->string('weight_total')->nullable();
            $table->string('trong_luong_mun')->nullable();
            $table->string('trong_luong_qua_co')->nullable();
            $table->string('trong_luong_vo')->nullable();
            $table->string('trong_luong_tap_chat')->nullable();
            $table->string('ty_le_mun')->nullable();
            $table->string('ty_le_qua_co')->nullable();
            $table->string('ty_le_vo')->nullable();
            $table->string('ty_le_tap_chat')->nullable();
            $table->string('do_kho')->nullable();
            $table->integer('is_online')->nullable();
            $table->integer('status')->nullable();
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
		Schema::drop('scale_rate');
	}

}
