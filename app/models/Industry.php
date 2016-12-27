<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Industry extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'industry';
    protected $fillable = ['name', 'description', 'created_by', 'updated_by'];

}