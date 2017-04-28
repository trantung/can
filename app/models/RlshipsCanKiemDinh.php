<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class RlshipsCanKiemDinh extends Eloquent  {

    use SoftDeletingTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rlships_can_kiemdinh';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $fillable = array('id_bang_can','id_chi_nhanh','app_id','id_so_phieu','id_bang_kd','id_ma_tau','kl_tong','kl_xe','kl_hang',
        'ty_le_mun','ty_le_qua_co','ty_le_vo','ty_le_tap_chat','id_status','type');
    protected $dates = ['deleted_at'];

///Relationships
//    public function rlshipskiemdinh()
//    {
//        return $this->hasOne('KiemDinh', 'id_bang_kd', 'id_bang_kd');
//    }
//    public function rlshipbangcan()
//    {
//        return $this->hasOne('BangCan', 'id_bang_can', 'id_bang_can');
//    }
}
