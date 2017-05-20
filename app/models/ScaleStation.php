<?php

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ScaleStation extends Eloquent
{
 // use SoftDeletingTrait;
    protected $table = 'scale_stations';
    protected $fillable = ['name', 'department_id', 'app_id', 'code', 'max_campaign_code'];
    protected $dates = ['deleted_at'];

    public function department()
    {
        return $this->hasOne('Company', 'id', 'department_id');
    }

    public function scopeDepartment($query, $department) {
		return $query->where('department_id', $department);
	}

}