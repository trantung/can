<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Position extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'positions';
    protected $fillable = ['name', 'description', 'branch_category_id', 'created_by', 'updated_by'];

}