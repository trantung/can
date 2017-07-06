<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Partner extends Eloquent
{
    use SoftDeletingTrait;
    protected $table = 'partners';
    protected $fillable = [
        'doi_tac_ten',
        'doi_tac_sdt',
        'doi_tac_dia_chi',
        'doi_tac_fax',
        'partner_id',
        'app_code',
        'scale_code',
    ];


}