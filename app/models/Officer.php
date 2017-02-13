<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Officer extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'officer';
    protected $fillable = ['name', 'created_by', 'updated_by'];

}