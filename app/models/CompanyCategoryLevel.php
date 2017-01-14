<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class CompanyCategoryLevel extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'company_category_level';
    protected $fillable = ['name', 'slug', 'created_by', 'updated_by'];
}