<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class CurrencyCategory extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'currency_category';
    protected $fillable = ['name', 'created_by', 'updated_by'];
}