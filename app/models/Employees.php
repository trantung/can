<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Employees extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'employees';
    protected $fillable = ['name', 'description', 'created_by', 'updated_by'];

}