<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class PartnerGroup extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'partner_groups';
    protected $fillable = ['name', 'created_by', 'updated_by'];

}