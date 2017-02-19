<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class EmploymentHistory extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'employment_history';
    protected $fillable = ['company_name', 'why_out', 'description', 'position','status', 'start_date', 'end_date', 'created_by', 'updated_by', 'personal_id', 'branch', 'officer', 'attach_file'];

    public function positionHistory()
    {
        return $this->hasOne('Company', 'id', 'position');
    }

    public function officerHistory()
    {
        return $this->hasOne('Officer', 'id', 'officer');
    }

    public function attachFile2()
    {
        return $this->hasOne('Files', 'model_id', 'id');
    }

}