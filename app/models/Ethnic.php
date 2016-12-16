<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Ethnic extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'ethnic';
    protected $fillable = ['name', 'description'];

}