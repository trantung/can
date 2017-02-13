 <!-- left column -->
<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12 personal-info">
        <div class="form-group form-group-sm">
            <label class="control-label">Mã nhân viên</label>
            <input value="NV {{$personal->id}}"  class="form-control input-sm" type="text" disabled>
        </div>
        {{-- ma_nv --}}
        <div class="form-group form-group-sm ">
            <label class="control-label">Giới tính</label>
            {{ Form::select('gioi_tinh', getSex(), $personal->gioi_tinh, array('class'=>'form-control input-sm')) }}
        </div>
        {{-- gioi_tinh --}}
         <div class="form-group form-group-sm">
            <label class="control-label">CMND</label>
            <input value="{{$personal->cmt}}"  class="form-control input-sm" type="text" name="cmt" placeholder="CMND">
        </div>
        {{-- cmt --}}
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
         <div class="form-group form-group-sm">
            <label class="control-label">Họ tên</label>
            <input value="{{$personal->ho_ten}}"  class="form-control input-sm" type="text" name="ho_ten" placeholder="Họ tên">
        </div>
        {{-- ho_ten --}}
        <div class="form-group form-group-sm ">
            <label class="control-label">Năm sinh</label>
            <input class="form-control input-sm" type="text" name="nam_sinh" id="datepicker1" placeholder="Năm sinh" value="{{$personal->nam_sinh }}">
        </div>
        {{-- nam_sinh --}}
        <div class="form-group form-group-sm ">
            <label class="control-label">Ngày cấp CMND</label>
            <input class="form-control input-sm" type="text" name="ngay_cap" id="datepicker2" placeholder="Ngày cấp CMND" value="{{$personal->ngay_cap}}">
        </div>
        {{-- ngay_cap --}}

    </div>
</div>


<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 personal-info">
        <div class="form-group form-group-sm">
            <label class="control-label">Địa chỉ thường trú</label>
            <input value="{{$personal->dia_chi_thuong_tru}}"  class="form-control input-sm" type="text" name="dia_chi_thuong_tru" placeholder="Địa chỉ thường trú">
        </div>
        {{-- dia_chi_thuong_tru --}}
        <div class="form-group form-group-sm">
            <label class="control-label">Địa chỉ tạm trú</label>
            <input value="{{$personal->dia_chi_tam_tru}}"  class="form-control input-sm" type="text" name="dia_chi_tam_tru" placeholder="Địa chỉ tạm trú">
        </div>
        {{-- dia_chi_tam_tru --}}
    </div>
</div>


<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12 personal-info">
        <div class="form-group form-group-sm">
            <label class="control-label">Dân tộc</label>
            {{ Form::select('dan_toc', $danh_sach_dan_toc, $personal->dan_toc, array('class'=>'form-control input-sm')) }}
        </div>
        {{-- dan_toc --}}
        <div class="form-group form-group-sm">
            <label class="control-label">Số hộ chiếu</label>
            <input value="{{$personal->ho_chieu}}"  class="form-control input-sm" type="text" name="ho_chieu" placeholder="Địa chỉ tạm trú">
        </div>
        {{-- ho_chieu --}}
        <div class="form-group form-group-sm ">
            <label class="control-label">Tình trạng hôn nhân</label>
            {{ Form::select('tinh_trang_hon_nhan', getMarryStatus(), $personal->tinh_trang_hon_nhan, array('class'=>'form-control')) }}
        </div>
        {{-- ngay_cap_ho_chieu --}}
        <div class="form-group form-group-sm">
            <label class="control-label">Số tài khoản</label>
            <input value="{{$personal->so_tai_khoan}}"  class="form-control input-sm" type="text" name="so_tai_khoan" placeholder="Số tài khoản">
        </div>
        {{-- so_tai_khoan --}}
        <div class="form-group form-group-sm ">
            <label class="control-label">Ngày vào làm</label>
            <input class="form-control input-sm" type="text" name="ngay_vao_cong_ty" id="datepicker5" placeholder="Ngày vào làm" value="{{$personal->ngay_vao_cong_ty}}">
        </div>
        {{-- ngay_vao_cong_ty --}}

    </div>
     <div class="col-md-6 col-sm-6 col-xs-12 personal-info">
        <div class="form-group form-group-sm">
            <label class="control-label">Tôn giáo</label>
            {{ Form::select('ton_giao', $danh_sach_ton_giao, $personal->ton_giao, array('class'=>'form-control input-sm')) }}
        </div>
        {{-- ton_giao --}}
         <div class="form-group form-group-sm ">
            <label class="control-label">Ngày cấp hộ chiếu</label>
            <input class="form-control input-sm" type="text" name="ngay_cap_ho_chieu" id="datepicker3" placeholder="Năm sinh" value="{{$personal->ngay_cap_ho_chieu}}">
        </div>
        {{-- ngay_cap_ho_chieu --}}
        <div class="form-group form-group-sm">
            <label class="control-label">Mã số thuế</label>
            <input value="{{$personal->ma_so_thue}}"  class="form-control input-sm" type="text" name="ma_so_thue" placeholder="Mã số thuế">
        </div>
        {{-- ho_chieu --}}
        <div class="form-group form-group-sm">
            <label class="control-label">Ngân hàng</label>
            <input value="{{$personal->ngan_hang}}"  class="form-control input-sm" type="text" name="ngan_hang" placeholder="Ngân hàng">
        </div>
        {{-- ngan_hang --}}
        <div class="form-group form-group-sm ">
            <label class="control-label">Ngày kết thúc thử việc</label>
            <input class="form-control input-sm" type="text" name="ngay_ket_thuc_thu_viec" id="datepicker6" placeholder="Ngày kết thúc thử việc" value="{{$personal->ngay_ket_thuc_thu_viec}}">
        </div>
        {{-- ngay_ket_thuc_thu_viec --}}


    </div>
</div>