<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class EmploymentEducational extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'employment_educational';
    protected $fillable = ['school_name', 'industry_id', 'certificate_id', 'graduation_year', 'created_by', 'updated_by', 'personal_id'];

}