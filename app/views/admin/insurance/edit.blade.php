@extends('admin.layout.default')

@section('title')
{{ $title='Sửa bảo hiểm' }}
@stop

@section('content')

@if(Admin::isAdmin())
<div class="row margin-bottom">
	<div class="col-xs-12">
		<a href="{{ action('InsuranceController@index') }}" class="btn btn-success">Danh sách bảo hiểm</a>
		<a href="{{ action('InsuranceController@create') }}" class="btn btn-primary">Thêm bảo hiểm</a>
	</div>
</div>
@endif

<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<!-- form start -->
			{{ Form::open(array('action' => array('InsuranceController@update', $data->id), 'method' => 'PUT')) }}
				          <div class="box-body">
            <div class="form-group">
              <label for="email">Nhân viên</label>
                <div class="row">
                      <div class="col-sm-6">
                        {{-- {{ Form::select('personal_id', $personal, $data->personal_id, array('class' =>'form-control')) }} --}}
                        <input type="text" class="form-control" id="personal_id" value="{{$data->personal_id}}" disabled>
                    </div>
                </div>
            </div>

            <div class="form-group">
              <label for="month">Tháng</label>
                <div class="row">
                  <div class="col-sm-6">
                    {{-- {{ Form::selectRange('month', 1, 12, $data->month, array('class' =>'form-control')) }} --}}
                    <input type="text" class="form-control" id="month" value="{{$data->month}}" disabled>
                </div>
            </div>

            <div class="form-group">
              <label for="total"> Tổng tiền bảo hiểm</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="total" placeholder="Tổng tiền bảo hiểm" name="total" value="{{$data->total}} ">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="description">Ghi chú</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="description" placeholder="Ghi chú" name="description" value="{{$data->description}}">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="pay_time">Thời gian đóng</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="pay_time" placeholder="Thời gian đóng" name="pay_time" value="{{$data->pay_time}}">
                    </div>
                </div>
            </div>


          </div>
				<!-- /.box-body -->

				<div class="box-footer">
					<input type="submit" class="btn btn-primary" value="Lưu lại" />
				</div>
			{{ Form::close() }}
		</div>
		<!-- /.box -->
	</div>
</div>

@stop
