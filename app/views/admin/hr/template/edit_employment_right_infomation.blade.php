 <!-- right column -->
<div class="row">
    <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
        <div class="form-group form-group-sm">
            <label class="control-label">Tên thường gọi</label>
            <input value="{{$personal->ten_thuong_goi}}"  class="form-control input-sm" type="text" name="ten_thuong_goi" placeholder="Tên thường gọi">
        </div>
        {{-- ten_thuong_goi --}}
        <div class="form-group form-group-sm">
            <label class="control-label">Nơi sinh</label>
            {{ Form::select('noi_sinh', $thanh_pho, $personal->noi_sinh, array('class'=>'form-control input-sm')) }}
        </div>
        {{-- noi_sinh --}}
        <div class="form-group form-group-sm ">
            <label class="control-label">Nơi cấp CMND</label>
            {{ Form::select('noi_cap', $thanh_pho, $personal->noi_cap, array('class'=>'form-control input-sm')) }}
        </div>
        {{-- noi_cap --}}
        <div class="form-group form-group-sm">
            <label class="control-label">Di động</label>
            <input value="{{$personal->mobile}}"  class="form-control input-sm" type="text" name="mobile" placeholder="Di động">
        </div>
        {{-- mobile --}}
        <div class="form-group form-group-sm">
            <label class="control-label">Email</label>
            <input value="{{$personal->email}}"  class="form-control input-sm" type="text" name="email" placeholder="Email">
        </div>
        {{-- email --}}
        <div class="form-group form-group-sm">
            <label class="control-label">Quốc tịch</label>
            <input value="{{$personal->quoc_tich}}"  class="form-control input-sm" type="text" name="quoc_tich" placeholder="Việt Nam">

        </div>
        {{-- quoc_tich --}}
        <div class="form-group form-group-sm">
            <label class="control-label">Nơi cấp hộ chiếu</label>
            <input value="{{$personal->noi_cap_ho_chieu}}"  class="form-control input-sm" type="text" name="noi_cap_ho_chieu" placeholder="Nơi cấp hộ chiếu">
        </div>
        {{-- noi_cap_ho_chieu --}}
        <div class="form-group form-group-sm ">
            <label class="control-label">Ngày cấp MST</label>
            <input class="form-control input-sm" type="text" name="ngay_cap_mst" id="datepicker4" placeholder="Ngày cấp MST" value="{{$personal->ngay_cap_mst}}">
        </div>
        {{-- ngay_cap_mst --}}
        <div class="form-group form-group-sm">
            <label class="control-label">Nguyên quán</label>
            <input value="{{$personal->nguyen_quan}}"  class="form-control input-sm" type="text" name="nguyen_quan" placeholder="Nguyên quán">
        </div>
        {{-- nguyen_quan --}}
         <div class="form-group form-group-sm">
            <label class="control-label">Lương cơ bản</label>
            <input value="{{$personal->luong_co_ban}}"  class="form-control input-sm" type="text" name="luong_co_ban" placeholder="lương cơ bản">
        </div>
        {{-- luong_co_ban --}}
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="text-center">

        <img src="{{url($personal->image)}}" class="avatar img-circle img-thumbnail" alt="avatar">
        <h6>Upload a photo...</h6>
        <input type="file" class="text-center center-block well well-sm" style="width: 100%" id="image" name="image">
      </div>
    </div>
</div>



