<?php

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ProductManage extends Eloquent
{
 // use SoftDeletingTrait;
    protected $table = 'product_manage';
    protected $fillable = ['product_id', 'product_category_id', 'company_id', 'level', 'ratio'];
    protected $dates = ['deleted_at'];

}