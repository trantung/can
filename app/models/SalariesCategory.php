<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class SalariesCategory extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'salaries_category';
    protected $fillable = ['name', 'created_by', 'updated_by'];
}