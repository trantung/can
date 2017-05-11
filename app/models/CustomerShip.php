<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class CustomerShip extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'customer_ships';
    protected $fillable = ['ship_code', 'customer_code', 'app_code', 'active', 'created_by', 'updated_by'];

}