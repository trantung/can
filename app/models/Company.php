<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Company extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'company';
    protected $fillable = ['name', 'description', 'created_by', 'updated_by'];

    public function branchs()
    {
        return $this->hasMany('Branch');
    }
}