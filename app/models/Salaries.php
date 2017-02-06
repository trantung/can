<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Salaries extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'salaries';
    protected $fillable = ['total', 'description', 'pay_time', 'created_by', 'personal_id', 'updated_by', 'month'];

}