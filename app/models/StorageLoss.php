<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class StorageLoss extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'storage_loss';
    protected $fillable = ['model_name', 'model_id', 'warehouse_id', 'ratio', 'active', 'created_by', 'updated_by'];

}