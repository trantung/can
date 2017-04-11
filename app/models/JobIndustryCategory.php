<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class JobIndustryCategory extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'job_industry';
    protected $fillable = ['name', 'created_by', 'updated_by'];
}