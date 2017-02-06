<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Insurance extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'insurance';
    protected $fillable = ['total', 'month', 'pay_time', 'created_by', 'personal_id', 'updated_by'];

}