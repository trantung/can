@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Thêm bảo hiểm' }}
@stop

@section('content')

<div class="row margin-bottom">
  <div class="col-xs-12">
    <a href="{{ action('InsuranceController@index') }}" class="btn btn-success">Danh sách bảo hiểm</a>
  </div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
        <!-- form start -->
        {{ Form::open(array('action' => 'InsuranceController@store')) }}
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
              <label for="total"> Tổng tiền bảo hiểm</label>
              <div class="row">
              	<div class="col-sm-6">
                	<input type="text" class="form-control" id="total" placeholder="Tổng tiền bảo hiểm" name="total" value="{{Input::old('total')}}">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="description">Ghi chú</label>
              <div class="row">
              	<div class="col-sm-6">
              		<input type="text" class="form-control" id="description" placeholder="Ghi chú" name="description" value="{{Input::old('description')}}">
              	</div>
              </div>
            </div>
            <div class="form-group">
              <label for="pay_time">Thời gian đóng</label>
              	<div class="row">
                	<div class="col-sm-6">
                		<input type="text" class="form-control" id="pay_time" placeholder="Thời gian đóng" name="pay_time" value="{{Input::old('pay_time')}}">
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