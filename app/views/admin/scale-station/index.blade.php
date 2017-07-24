@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Danh sách' }}
@stop

@section('content')

    <div class="row margin-bottom">
        <div class="col-xs-12">
            <a href="{{ action('ScaleStationController@create') }}" class="btn btn-primary">Thêm mới</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh sách</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>STT</th>
                  <th>Tên trạm cân</th>
                  <th>Mã Trạm cân</th>
                  <th>Mã AppId</th>
                  <th>Chi nhánh</th>
                  <th style="width:200px;">Action</th>
                  <th style="width:200px;">Huỷ appid ở trạm cân</th>
                </tr>
                @foreach($data as $key => $value)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $value->name }}</td>
                   <td>{{ $value->code }}</td>
                   <td>{{ $value->app_id }}</td>
                   <td>{{ $value->department <> null ?  $value->department->name : ''}}</td>
                  <td>
                    <a href="{{ action('ScaleStationController@edit', $value->id) }}" class="btn btn-primary">Sửa</a>
                    <a href="{{ action('ScaleStationController@getPercent', $value->id) }}" class="btn btn-primary">Phần trăm</a>
                    {{ Form::open(array('method'=>'DELETE', 'action' => array('ScaleStationController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
                    <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa trạm cân</button>
                    {{ Form::close() }}
                  </td>
                  <td>
                    {{ Form::open(array('method'=>'POST', 'action' => array('ScaleStationController@postDestroyApp', $value->id), 'style' => 'display: inline-block;')) }}
                    <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn huỷ app id ở trạm cân này?');">Huỷ appid</button>
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
