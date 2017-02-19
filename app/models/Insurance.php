<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Insurance extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'insurance';
    protected $fillable = ['total', 'month', 'year', 'description', 'pay_time', 'created_by', 'personal_id', 'updated_by'];

        public function user()
    {
        return $this->hasOne('PersonalInfo', 'id', 'personal_id');
    }

}