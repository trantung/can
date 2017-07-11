<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class PercentWarehouse extends Eloquent
{
    protected $table = 'percent_warehouse';
    protected $fillable = ['tilekho', 'tilemun', 'tilequaco', 'doam',
    	'model_id', 'model_name', 'ty_le_mun',
    	'ty_le_qua_co', 'ty_le_vo', 'ty_le_tap_chat',
    	'do_kho',
    ];

}