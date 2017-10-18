<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ProductionAuto extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'production_auto';
    protected $fillable = [
	    'department_id', 
	    'warehouse_id', 
	    'product_category_id', 
	    'product_id', 
	    'product_loss_id', 
	    'storage_loss_id', 
	    'status', 
	    'created_by', 
	    'updated_by',
	    'product_category_weight',
	    'warehouse_output_id',
	    'product_weight',
	    'storage_weight',
	    'code',
	    'department_output_id',
    ];

}