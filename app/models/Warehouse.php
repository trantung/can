<?php

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Warehouse extends Eloquent
{
 // use SoftDeletingTrait;
    protected $table = 'warehouse';
    protected $fillable = ['name', 'department_id'];
    protected $dates = ['deleted_at'];

    public function department()
    {
        return $this->hasOne('Company', 'id', 'department_id');
    }

}