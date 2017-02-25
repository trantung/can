<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Salaries extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'salaries';
    protected $fillable = ['total', 'description', 'pay_time', 'created_by', 'personal_id', 'updated_by', 'year', 'month', 'ngay_cong', 'ngay_di_lam', 'luong_trach_nhiem', 'phu_cap', 'kieu_luong'];


    public function user()
    {
        return $this->hasOne('PersonalInfo', 'id', 'personal_id');
    }

}