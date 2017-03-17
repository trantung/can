@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Quản lý bảo hiểm' }}
@stop

@section('content')

	<!-- inclue Search form -->
	{{-- @include('admin.manager.search') --}}

	<div class="row margin-bottom">
		<div class="col-xs-12">
			<a href="{{ action('InsuranceController@create') }}" class="btn btn-primary">Thêm bảo hiểm</a>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
		  <div class="box">
			<div class="box-header">
			  <h3 class="box-title">Danh sách bảo hiểm</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body table-responsive no-padding">
			  <table class="table table-hover">
				<tr>
				  <th>#</th>
				  <th>Tên</th>
                  <th>BHYT</th>
                  <th>BHXH</th>
                  <th>Tháng</th>
                  <th>Năm</th>
                  <th>Ghi chú</th>
				  <th>Ngày đóng</th>
				  <th style="width:200px;">Action</th>
				</tr>
				@foreach($data as $key => $value)
				<tr>
				  <td>{{ $key+1 }}</td>
				  <td>{{  $value->user->ho_ten }}</td>
                  <td>{{ $value->bhyt }}</td>
                  <td>{{ $value->bhxh }}</td>
                  <td>{{ $value->month }}</td>
                  <td>{{ $value->year }}</td>
                  <td>{{ $value->description }}</td>
                  <td>{{ $value->pay_time }}</td>
				  <td>
					<a href="{{ action('InsuranceController@edit', $value->id) }}" class="btn btn-primary">Sửa</a>
					{{ Form::open(array('method'=>'DELETE', 'action' => array('InsuranceController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
					<button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
					{{ Form::close() }}

				  </td>
				</tr>
				@endforeach
			  </table>
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			{{ $data->appends(Request::except('page'))->links() }}
		</div>
	</div>

@stop
@endif
