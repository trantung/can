<?php

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class UserPersonal extends Eloquent
{
 // use SoftDeletingTrait;
    protected $table = 'user_personal';
    protected $fillable = ['user_id', 'personal_id'];
    protected $dates = ['deleted_at'];

}