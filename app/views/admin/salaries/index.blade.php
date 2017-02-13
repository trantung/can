@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Quản lý lương' }}
@stop

@section('content')

	<!-- inclue Search form -->
	{{-- @include('admin.manager.search') --}}

	<div class="row margin-bottom">
		<div class="col-xs-12">
			<a href="{{ action('SalariesController@create') }}" class="btn btn-primary">Thêm lương</a>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
		  <div class="box">
			<div class="box-header">
			  <h3 class="box-title">Danh sách lương</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body table-responsive no-padding">
			  <table class="table table-hover">
				<tr>
				  <th>#</th>
				  <th>Username</th>
                  <th>Ngày công</th>
                  <th>Ngày đi làm  </th>
                  <th>Lương trách nhiệm</th>
                  <th>Phụ cấp</th>
                  <th>Kiểu lương</th>
                  <th>Tháng</th>
                  <th>Ghi chú</th>
				  <th>Ngày trả</th>
				  <th style="width:200px;">Action</th>
				</tr>
				@foreach($data as $key => $value)
				<tr>
				  <td>{{ $key+1 }}</td>
				  <td>{{ $value->personal_id }}</td>
                  <td>{{ $value->ngay_cong }}</td>
                  <td>{{ $value->ngay_di_lam }}</td>
                  <td>{{ $value->luong_trach_nhiem }}</td>
                  <td>{{ $value->phu_cap }}</td>
                  <td>{{ $value->kieu_luong }}</td>
                  <td>{{ $value->total }}</td>
                  <td>{{ $value->month }}</td>
                  <td>{{ $value->description }}</td>
                  <td>{{ $value->pay_time }}</td>
				  <td>
					<a href="{{ action('SalariesController@edit', $value->id) }}" class="btn btn-primary">Sửa</a>
					{{ Form::open(array('method'=>'DELETE', 'action' => array('SalariesController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
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
