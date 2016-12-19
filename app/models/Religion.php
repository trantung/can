<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Religion extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'religions';
    protected $fillable = ['name', 'description', 'created_by', 'updated_by'];

}