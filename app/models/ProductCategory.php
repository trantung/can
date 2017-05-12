<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ProductCategory extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'product_categories';
    protected $fillable = ['name', 'description', 'status', 'created_by', 'updated_by', 'code'];

}