 <!-- left column -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="text-center">
        <img src="{{asset($personal->image)}}" class="avatar img-circle img-thumbnail" alt="avatar">
        <h6>Upload a photo...</h6>
        <input type="file" class="text-center center-block well well-sm" style="width: 100%" id="image" name="image">
      </div>
    </div>
    <!-- edit form column -->
    <div class="col-md-9 col-sm-6 col-xs-12 personal-info">
      {{-- <div class="alert alert-info alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a>
        <i class="fa fa-coffee"></i>
        This is an <strong>.alert</strong>. Use this to show important messages to the user.
      </div> --}}
        <div class="form-group form-group-sm row ">
          <div class="col-lg-8">
          <label class="control-label">Họ tên</label>
            <input class="form-control input-sm" type="text" name="fullname" placeholder="Họ tên" value="{{$personal->fullname}}">
          </div>
        </div>
        {{-- full name --}}
        <div class="form-group form-group-sm row">
          <div class="col-lg-8">
          <label class="control-label">Mã nhân viên</label>
            <input class="form-control input-sm" type="text" name="id_employees" placeholder="Mã nhân viên" value="{{$personal->id_employees}}">
          </div>
        </div>
        {{-- id --}}

        <div class="form-group form-group-sm row">
          <div class="col-lg-8">
          <label class="control-label">Tên thường gọi</label>
            <input class="form-control input-sm" placeholder="Tên thường gọi" type="text" name="nickname" value="{{$personal->nickname}}">
          </div>
        </div>
        {{-- nickname --}}
        <div class="form-group form-group-sm row">
          <div class="col-lg-8">
          <label class="control-label">Năm sinh</label>
            <input class="form-control input-sm" type="text" name="birthday" id="datepickerStartdate" placeholder="Năm sinh" value="{{$personal->birthday}}">
          </div>
        </div>
        {{-- birthday --}}
        <div class="form-group form-group-sm row">
            <div class="col-lg-8">
            <label class="control-label">Địa chỉ</label>
                <input class="form-control input-sm" type="text" name="address" placeholder="Địa chỉ" value="{{$personal->address}}">
            </div>
        </div>
        {{-- address --}}

        <div class="form-group form-group-sm row">
          <div class="col-lg-8">
          <label class="control-label">Tình trạng hôn nhân</label>
            {{ Form::select('marry', getMarryStatus(), $personal->marry, array('class'=>'form-control')) }}

          </div>
        </div>
        {{-- marry --}}

        <div class="form-group form-group-sm row">
          <div class="col-lg-8">
          <label class="control-label">Điện thoại</label>
            <input class="form-control input-sm" type="text" name="mobile" placeholder="Số điện thoại" value="{{$personal->mobile}}">
          </div>
        </div>
        {{-- mobile --}}
         <div class="form-group form-group-sm row">
          <div class="col-lg-8">
          <label class="control-label">Email</label>
            <input class="form-control input-sm" type="email" name="email" placeholder="Email" value="{{$personal->email}}">
          </div>
        </div>
        {{-- email --}}

    </div>