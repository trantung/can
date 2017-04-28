<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class BangCanLog extends Eloquent  {

    use SoftDeletingTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bang_can_log';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $fillable = array('id_bang_can', 'id_so_phieu','id_chi_nhanh','user_id','session_id','id_action',
        'id_status','id_kho','id_ma_tau','id_kh','ten_kh','so_xe','ten_hang','kho','ngay_can',
        'gio_can_lan_1','gio_can_lan_2','xuat_nhap','kl_tong','kl_xe','kl_tap_chat','kl_hang','luong_tru','tap_chat','don_gia',
        'thanh_tien','don_vi_kl','don_vi_ty_le','id_cty', 'app_id','can_lan1','can_lan2');
    protected $dates = ['deleted_at'];
}
