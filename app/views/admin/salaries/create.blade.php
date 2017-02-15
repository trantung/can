@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Thêm lương' }}
@stop

@section('content')

<div class="row margin-bottom">
  <div class="col-xs-12">
    <a href="{{ action('SalariesController@index') }}" class="btn btn-success">Danh sách lương</a>
  </div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
        <!-- form start -->
        {{ Form::open(array('action' => 'SalariesController@store')) }}
          <div class="box-body">
            <div class="form-group">
              <label for="email">Nhân viên</label>
                <div class="row">
                      <div class="col-sm-6">
                        {{ Form::select('personal_id', $personal, Input::old('personal_id'), array('class' =>'form-control')) }}
                    </div>
                </div>
            </div>

            <div class="form-group">
              <label for="month">Tháng</label>
                <div class="row">
                  <div class="col-sm-6">
                    {{ Form::selectRange('month', 1, 12, Input::old('month'), array('class' =>'form-control')) }}
                </div>
            </div>

            <div class="form-group">
              <label for="total"> Tổng tiền lương</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="total" placeholder="Tổng tiền lương" name="total" value="{{Input::old('total')}}">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="ngay_cong"> Ngày công</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="ngay_cong" placeholder="Ngày công" name="ngay_cong" value="{{Input::old('ngay_cong')}}">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="ngay_di_lam"> Ngày đi làm</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="ngay_di_lam" placeholder="Ngày đi làm" name="ngay_di_lam" value="{{Input::old('ngay_di_lam')}}">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="luong_trach_nhiem"> Lương trách nhiệm</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="luong_trach_nhiem" placeholder="Lương trách nhiệm" name="luong_trach_nhiem" value="{{Input::old('luong_trach_nhiem')}}">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="phu_cap"> Phụ cấp</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="phu_cap" placeholder="Phụ cấp" name="phu_cap" value="{{Input::old('phu_cap')}}">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="kieu_luong"> Kiểu lương</label>
              <div class="row">
              	<div class="col-sm-6">
                    {{ Form::select('kieu_luong', $salaries_category, Input::old('kieu_luong'), array('class' =>'form-control')) }}
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="pay_time">Thời gian trả</label>
              	<div class="row">
                	<div class="col-sm-6">
                		<input type="text" class="form-control" id="pay_time" placeholder="Thời gian trả" name="pay_time" value="{{Input::old('pay_time')}}">
            		</div>
      			</div>
            </div>


            <div class="form-group">
              <label for="description">Ghi chú</label>
              <div class="row">
                <div class="col-sm-6">
                <textarea class="form-control" id="description" placeholder="Ghi chú" name="description">{{Input::old('description')}}</textarea>
                </div>
                </div>
              </div>
            </div>

          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <input type="submit" class="btn btn-primary" value="Lưu lại" />
            <input type="reset" class="btn btn-default" value="Nhập lại" />
          </div>
        {{ Form::close() }}
      </div>
      <!-- /.box -->
	</div>
</div>

@stop
@endif