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
            'ma_nv',
            'ho_ten',
            'ten_thuong_goi',
            'image',
            'gioi_tinh',
            'nam_sinh',
            'noi_sinh',
            'cmt',
            'ngay_cap',
            'noi_cap',
            'dia_chi_thuong_tru',
            'dia_chi_tam_tru',
            'mobile',
            'email',
            'dan_toc',
            'ton_giao',
            'quoc_tich',
            'ho_chieu',
            'ngay_cap_ho_chieu',
            'noi_cap_ho_chieu',
            'tinh_trang_hon_nhan',
            'ma_so_thue',
            'ngay_cap_mst',
            'so_tai_khoan',
            'ngan_hang',
            'nguyen_quan',

            'loai_nhan_vien',
            'ngay_vao_cong_ty',
            'thoi_gian_thu_viec',
            'don_vi',
            'chuc_danh',
            'chuc_vu',
            'phong_ban',
            'bo_phan',
            'dia_diem_lam_viec',

            'created_by',
            'updated_by'
        );
    protected $dates = ['deleted_at'];

    public function employmentEducational()
    {
        return $this->hasMany('EmploymentEducational', 'personal_id');
    }

    public function employmentHistory()
    {
        return $this->hasMany('EmploymentHistory', 'personal_id');
    }

    public function employmentFiles()
    {
        return $this->hasMany('Files', 'personal_id');
    }

    public function employmentBonusHistory()
    {
        return $this->hasMany('BonusHistory', 'personal_id');
    }

}
