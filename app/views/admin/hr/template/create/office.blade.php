<div class="row">
    <div class="col-md-3 col-xs-12 personal-office">
        <div class="form-group form-group-sm ">
            <label class="control-label">Đơn vị</label>
            {{ Form::select('don_vi', $danh_sach_don_vi, Input::old('don_vi'), array('class'=>'form-control input-sm')) }}
        </div>
        {{-- don_vi --}}
        <div class="form-group form-group-sm ">
            <label class="control-label">Chức danh</label>
            {{ Form::select('chuc_danh', $danh_sach_chuc_danh, Input::old('chuc_danh'), array('class'=>'form-control input-sm')) }}
        </div>
        {{-- chuc_danh --}}
        <div class="form-group form-group-sm ">
            <label class="control-label">Phòng ban</label>
            {{ Form::select('phong_ban', $danh_sach_phong_ban, Input::old('phong_ban'), array('class'=>'form-control input-sm')) }}
        </div>
        {{-- phong_ban --}}
    </div>
    <div class="col-md-3 col-xs-12 personal-office">

        <div class="form-group form-group-sm ">
            <label class="control-label">Chức vụ</label>
            {{ Form::select('chuc_vu', $danh_sach_chuc_vu, Input::old('chuc_vu'), array('class'=>'form-control input-sm')) }}
        </div>
        {{-- chuc_vu --}}
        <div class="form-group form-group-sm ">
            <label class="control-label">Bộ phận</label>
            {{ Form::select('bo_phan', $danh_sach_bo_phan, Input::old('bo_phan'), array('class'=>'form-control input-sm')) }}
        </div>
        {{-- bo_phan --}}
        <div class="form-group form-group-sm ">
            <label class="control-label">Địa điểm làm việc</label>
            {{ Form::select('dia_diem_lam_viec', $danh_sach_dia_diem_lam_viec, Input::old('dia_diem_lam_viec'), array('class'=>'form-control input-sm')) }}
        </div>
        {{-- dia_diem_lam_viec --}}

    </div>
    <div class="col-md-3 col-xs-12 personal-office">
        <div class="form-group form-group-sm ">
            <label class="control-label">Loại nhân viên</label>
            {{ Form::select('loai_nhan_vien', $danh_sach_loai_nhan_vien, Input::old('loai_nhan_vien'), array('class'=>'form-control input-sm')) }}
        </div>
        {{-- loai_nhan_vien --}}
        <div class="form-group form-group-sm ">
            <label class="control-label">Ngày vào công ty</label>
            <input class="form-control input-sm" type="text" name="ngay_vao_cong_ty" id="datepicker4" placeholder="Ngày vào công ty" {{Input::old('ngay_vao_cong_ty')}}>
        </div>
        {{-- ngay_vao_cong_ty --}}
        <div class="form-group form-group-sm ">
            <label class="control-label">Thời gian thử việc</label>
            {{ Form::select('thoi_gian_thu_viec', $danh_sach_thoi_gian_thu_viec, Input::old('thoi_gian_thu_viec'), array('class'=>'form-control input-sm')) }}
        </div>
        {{-- thoi_gian_thu_viec --}}
    </div>
</div>