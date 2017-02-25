@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Danh sách nhóm quyền' }}
@stop

@section('content')

	<div class="row margin-bottom">
		<div class="col-xs-12">
			<a href="{{ action('PermissionController@createRole') }}" class="btn btn-primary">Thêm nhóm quyền</a>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
		  <div class="box">
			<div class="box-header">
			  <h3 class="box-title">Danh sách nhóm quyền</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body table-responsive no-padding">
			  <table class="table table-hover">
				<tr>
				  <th>#</th>
				  <th>Tên nhóm quyền</th>
				  <th style="width:200px;">Action</th>
				</tr>
				@foreach($data as $key => $value)
				<tr>
				  <td>{{ $key+1 }}</td>
				  <td>{{ $value->name }}</td>
				  <td>
					<a href="{{ action('PermissionController@edit', $value->id) }}" class="btn btn-primary">Sửa</a>
					{{ Form::open(array('method'=>'DELETE', 'action' => array('PermissionController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
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

	

@stop
@endif
