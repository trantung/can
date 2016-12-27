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
            $table->string('fullname', 255)->nullable();
            $table->string('id_employees', 255)->nullable();
            $table->string('nickname', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->date('birthday')->nullable();
            $table->string('address', 255)->nullable();
            $table->enum('marry',  array('Y', 'N', 'O'))->default('O');
            $table->integer('mobile')->nullable()->unique();
            $table->string('email', 255)->nullable()->unique();
            $table->integer('idcard')->nullable()->unique()->unsigned();
            $table->date('date_of_issue', 255)->nullable();
            $table->string('place_of_issue', 255)->nullable();
            $table->enum('sex', array('M', 'F', 'O'))->default('M');
            $table->integer('tax_code')->nullable()->unique()->unsigned();
            $table->integer('insurance_id')->nullable()->unsigned();
            $table->string('bank_id', 255)->nullable();
            $table->string('bank_name', 255)->nullable();
            // $table->integer('company_id')->unsigned()->nullable();
            $table->integer('ethnic_group_id')->nullable()->unsigned();
            $table->integer('religion_category_id')->nullable()->unsigned();
            $table->integer('nationality_category_id')->nullable()->unsigned();
            $table->integer('branch_category_id')->unsigned()->nullable();
            $table->integer('position_category_id')->nullable()->unsigned();
            $table->integer('employees_category_id')->nullable()->unsigned();
            $table->integer('contract_category_id')->nullable()->unsigned();
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
