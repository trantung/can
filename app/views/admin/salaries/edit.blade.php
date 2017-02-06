@extends('admin.layout.default')

@section('title')
{{ $title='Sửa lương' }}
@stop

@section('content')

@if(Admin::isAdmin())
<div class="row margin-bottom">
	<div class="col-xs-12">
		<a href="{{ action('SalariesController@index') }}" class="btn btn-success">Danh sách lương</a>
		<a href="{{ action('SalariesController@create') }}" class="btn btn-primary">Thêm lương</a>
	</div>
</div>
@endif

<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<!-- form start -->
			{{ Form::open(array('action' => array('SalariesController@update', $data->id), 'method' => 'PUT')) }}
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
              <label for="total"> Tổng tiền lương</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="total" placeholder="Tổng tiền lương" name="total" value="{{$data->total}} ">
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
              <label for="pay_time">Thời gian trả</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="pay_time" placeholder="Thời gian trả" name="pay_time" value="{{$data->pay_time}}">
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
