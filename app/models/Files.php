<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Files extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'files';
    protected $fillable = ['name', 'link', 'created_by', 'personal_id', 'updated_by'];

}