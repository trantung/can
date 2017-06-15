<?php

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ConfigProperty extends Eloquent
{
 use SoftDeletingTrait;
    protected $table = 'config_properties';
    protected $fillable = ['model_name', 'model_id', 'warehouse_id', 'data', 'status', 'department_id'];
    protected $dates = ['deleted_at'];

    public function getDataAttribute($value)
    {
        return json_decode($value);
    }

}