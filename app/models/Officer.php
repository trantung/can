<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Officer extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'officer';
    protected $fillable = ['name', 'position_id', 'created_by', 'updated_by'];

    public function categoryName()
    {
        return $this->hasOne('Position', 'id', 'position_id');
    }

}