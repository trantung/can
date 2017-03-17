<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class BankCategory extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'bank_category';
    protected $fillable = ['name', 'created_by', 'updated_by'];
}