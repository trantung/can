<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ProductionLoss extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'production_loss';
    protected $fillable = ['number', 'status', 'created_by', 'updated_by'];

}