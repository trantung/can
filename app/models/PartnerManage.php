<?php

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class PartnerManage extends Eloquent
{
 // use SoftDeletingTrait;
    protected $table = 'partner_manage';
    protected $fillable = ['partner_group_id', 'partner_id'];
    protected $dates = ['deleted_at'];

}