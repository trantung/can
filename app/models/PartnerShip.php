<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class PartnerShip extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'partner_ships';
    protected $fillable = [
	    'ship_code', 
	    'partner_code', 
	    'app_code', 
	    'created_by', 
	    'updated_by',
    ];

}