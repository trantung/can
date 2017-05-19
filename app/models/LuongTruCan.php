<?php

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class LuongTruCan extends Eloquent
{
 // use SoftDeletingTrait;
    protected $table = 'luongtru_maphieu_can';
    protected $fillable = ['ma_cd', 'ma_phieu_can', 'luongtru'];
    protected $dates = ['deleted_at'];

}