<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleRolePermissionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('module_role_permission', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('module_id')->nullable();
            $table->integer('role_id')->nullable();
            $table->integer('permission_id')->nullable();
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
		Schema::drop('module_role_permission');
	}

}
