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
              <label for="description">Ghi chú</label>
              <div class="row">
              	<div class="col-sm-6">
              		<input type="text" class="form-control" id="description" placeholder="Ghi chú" name="description" value="{{Input::old('description')}}">
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