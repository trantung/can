<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class PersonalInfo extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;
    use SoftDeletingTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'personal_info';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $fillable = array(
        'fullname',
        'id_employees',
        'nickname',
        'image',
        'birthday',
        'address',
        'marry',
        'mobile',
        'email',
        'idcard',
        'date_of_issue',
        'place_of_issue',
        'sex',
        'tax_code',
        'insurance_id',
        'bank_id',
        'bank_name',
        // 'company_id',
        'nationnality_category_id',
        'branch_category_id',
        'position_category_id',
        'employees_category_id',
        'ethnic_group_id',
        'religion_category_id',
        'contract_category_id',
        'created_by',
        'updated_by',
        );
    protected $dates = ['deleted_at'];


}
