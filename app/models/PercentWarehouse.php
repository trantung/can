<?php

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class PercentWarehouse extends Eloquent
{
 // use SoftDeletingTrait;
    protected $table = 'percent_warehouse';
    protected $fillable = ['model_name', 'model_id', 'warehouse_id', 'ty_le_mun', 'ty_le_qua_co', 'ty_le_vo', 'ty_le_tap_chat', 'do_kho'];
    protected $dates = ['deleted_at'];

}