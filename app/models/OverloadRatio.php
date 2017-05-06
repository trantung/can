<?php

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class OverloadRatio extends Eloquent
{
 // use SoftDeletingTrait;
    protected $table = 'overload_ratio';
    protected $fillable = ['model_name', 'model_id', 'data'];
    protected $dates = ['deleted_at'];

    public function getDataAttribute($value)
    {
        return json_decode($value);
    }

}