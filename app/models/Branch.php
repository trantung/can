<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Branch extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'branchs';
    protected $fillable = ['name', 'address', 'company_id', 'created_by', 'updated_by'];

}