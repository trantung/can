<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class BonusHistory extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'bonus_history';
    protected $fillable = ['why_bonus', 'description', 'date', 'created_by', 'personal_id', 'updated_by'];

}