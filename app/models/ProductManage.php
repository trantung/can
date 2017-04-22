<?php

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ProductManage extends Eloquent
{
 // use SoftDeletingTrait;
    protected $table = 'product_manage';
    protected $fillable = ['product_id', 'product_category_id'];
    protected $dates = ['deleted_at'];

}