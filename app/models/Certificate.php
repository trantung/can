<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Certificate extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'certificate';
    protected $fillable = ['name', 'description', 'created_by', 'updated_by'];

}