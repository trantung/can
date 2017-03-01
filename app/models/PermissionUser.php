<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class PermissionUser extends Eloquent
{
 // use SoftDeletingTrait;
    protected $table = 'permission_users';
    protected $fillable = ['user_id', 'permission_id'];
    protected $dates = ['deleted_at'];

}