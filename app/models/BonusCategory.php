<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class BonusCategory extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'bonus_catogory';
    protected $fillable = ['name', 'created_by', 'updated_by'];

}