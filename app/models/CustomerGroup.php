<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class CustomerGroup extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'customer_groups';
    protected $fillable = [
   		'name',
    	'created_by',
    	'updated_by',
    	'code',
    	'description',
    	'phone',
    	'fax',
    	'email',
    ];

}