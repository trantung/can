<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class EmploymentHistory extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'employment_history';
    protected $fillable = ['company_name', 'why_out', 'description', 'position','status', 'start_date', 'end_date', 'created_by', 'updated_by', 'personal_id', 'branch'];

}