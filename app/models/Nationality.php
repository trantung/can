<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Nationality extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'nationality';
    protected $fillable = ['name', 'description', 'created_by', 'updated_by'];

}