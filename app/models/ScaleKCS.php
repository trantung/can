<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ScaleKCS extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'scale_rate';
    protected $fillable = [
    	'user_id',
        'number_ticket',
        'number_car',
        'category_id',
        'transfer_type',
        'warehouse_id',
        'department_id',
        'campaign_name',
        'campaign_method',
        'campaign_code',
        'customer_id',
        'customer_name',
        'customer_phone',
        'customer_address',
        'customer_fax',
        'scale_at',
        'first_scale_hour',
        'second_scale_hour',
        'first_scale_weight',
        'second_scale_weight',
        'package_weight',
        'app_id',
        'code',
        'type',
        'weight_total',
        'trong_luong_mun',
        'trong_luong_qua_co',
        'trong_luong_vo',
        'trong_luong_tap_chat',
        'ty_le_mun',
        'ty_le_qua_co',
        'ty_le_vo',
        'ty_le_tap_chat',
        'do_kho',
        'is_online',
        'status',
        'number_ticket_manual',
        'created_at',
        'process',
    ];


}