<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Contract extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'contracts';
    protected $fillable = ['name', 'description'];

}