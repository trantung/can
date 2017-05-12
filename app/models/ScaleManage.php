<?php

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ScaleManage extends Eloquent
{
 // use SoftDeletingTrait;
    protected $table = 'scale_manage';
    protected $fillable = ['scale_station_code', 'app_id', 'active'];
    protected $dates = ['deleted_at'];

}