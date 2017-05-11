<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Customer extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'customers';
    protected $fillable = ['scale_station_code', 'scale_coupon', 'customer_code', 'group_id', 'created_by', 'updated_by'];

}