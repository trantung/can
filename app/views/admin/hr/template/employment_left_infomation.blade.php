 <!-- left column -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="text-center">

        <img src="{{asset(DEFAULT_PICTURE)}}" class="avatar img-circle img-thumbnail" alt="avatar">
        <h6>Upload a photo...</h6>
        <input type="file" class="text-center center-block well well-sm" style="width: 100%" id="image" name="image">

        <h6>Upload a cv...</h6>
        <input type="file" class="text-center center-block well well-sm" style="width: 100%" id="cv" name="cv">
      </div>

    </div>
    <!-- edit form column -->
    <div class="col-md-9 col-sm-6 col-xs-12 personal-info">
      {{-- <div class="alert alert-info alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a>
        <i class="fa fa-coffee"></i>
        This is an <strong>.alert</strong>. Use this to show important messages to the user.
      </div> --}}
        <div class="form-group form-group-sm row">
          <div class="col-lg-8">
            <input class="form-control input-sm" type="text" name="fullname" placeholder="Họ tên">
          </div>
        </div>
        {{-- full name --}}
        <div class="form-group form-group-sm row">
          <div class="col-lg-8">
            <input class="form-control input-sm" type="text" name="id_employees" placeholder="Mã nhân viên">
          </div>
        </div>
        {{-- id --}}

        <div class="form-group form-group-sm row">
          <div class="col-lg-8">
            <input class="form-control input-sm" placeholder="Tên thường gọi" type="text" name="nickname">
          </div>
        </div>
        {{-- nickname --}}
        <div class="form-group form-group-sm row">
          <div class="col-lg-8">
            <input class="form-control input-sm" type="text" name="birthday" id="datepickerStartdate" placeholder="Năm sinh">
          </div>
        </div>
        {{-- birthday --}}
        <div class="form-group form-group-sm row">
            <div class="col-lg-8">
                <input class="form-control input-sm" type="text" name="address" placeholder="Địa chỉ">
            </div>
        </div>
        {{-- address --}}

        <div class="form-group form-group-sm row">
          <div class="col-lg-8">
            {{ Form::select('marry', getMarryStatus(), 'Y', array('class'=>'form-control')) }}
          </div>
        </div>
        {{-- marry --}}

        <div class="form-group form-group-sm row">
          <div class="col-lg-8">
            <input class="form-control input-sm" type="text" name="mobile" placeholder="Số điện thoại">
          </div>
        </div>
        {{-- mobile --}}
         <div class="form-group form-group-sm row">
          <div class="col-lg-8">
            <input class="form-control input-sm" type="email" name="email" placeholder="Email">
          </div>
        </div>
        {{-- email --}}

    </div>