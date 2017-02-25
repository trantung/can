<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ModuleRolePermission extends Eloquent
{
	// use SoftDeletingTrait;
    protected $table = 'module_role_permission';
    protected $fillable = ['module_id', 'role_id', 'permission_id'];
    protected $dates = ['deleted_at'];

}