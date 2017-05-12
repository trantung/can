<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Product extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'products';
    protected $fillable = ['name', 'description', 'status', 'created_by', 'updated_by', 'code'];

}