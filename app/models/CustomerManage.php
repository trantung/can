<?php

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class CustomerManage extends Eloquent
{
 // use SoftDeletingTrait;
    protected $table = 'customer_manage';
    protected $fillable = ['customer_group_id', 'customer_id'];
    protected $dates = ['deleted_at'];

}