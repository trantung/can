<?php

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class WarehouseHistory extends Eloquent
{
 // use SoftDeletingTrait;
    protected $table = 'warehouse_history';
    protected $fillable = ['arrive', 'receive'];
    protected $dates = ['deleted_at'];

}