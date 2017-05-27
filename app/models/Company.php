<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Company extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'company';
    protected $fillable = ['name', 'description', 'created_by', 'updated_by',
        'fax', 'phone', 'email',
     'level', 'parent_id', 'code'];

    // public function branchs()
    // {
    //     return $this->hasMany('Branch');
    // }

    public function scopeLevel($query, $level) {
		return $query->where('level', $level);
	}

    public function warehouse()
    {
        return $this->hasMany('Warehouse','department_id');
    }


}