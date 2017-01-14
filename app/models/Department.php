<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Department extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'department';
    protected $fillable = ['name', 'description', 'created_by', 'updated_by'];

}