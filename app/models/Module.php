<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Module extends Eloquent
{
	use SoftDeletingTrait;
    protected $table = 'modules';
    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];

}