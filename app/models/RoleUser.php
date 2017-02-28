<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class RoleUser extends Eloquent
{
 // use SoftDeletingTrait;
    protected $table = 'role_users';
    protected $fillable = ['user_id', 'role_id'];
    protected $dates = ['deleted_at'];

}