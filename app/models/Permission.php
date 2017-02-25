<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Permission extends Eloquent
{
 // use SoftDeletingTrait;
    protected $table = 'permissions';
    protected $fillable = ['module_id', 'name'];
    protected $dates = ['deleted_at'];

}