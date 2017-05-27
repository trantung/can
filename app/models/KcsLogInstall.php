<?php

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class KcsLogInstall extends Eloquent
{
 use SoftDeletingTrait;
    protected $table = 'kcs_log_install';
    protected $fillable = ['department_id', 'app_id', 'status', 'department_code'];
    protected $dates = ['deleted_at'];

}