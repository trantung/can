<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class BonusHistory extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'bonus_history';
    protected $fillable = ['category', 'description', 'date', 'created_by', 'personal_id', 'updated_by'];

    public function categoryName()
    {
        return $this->hasOne('BonusCategory', 'id', 'category');
    }

}