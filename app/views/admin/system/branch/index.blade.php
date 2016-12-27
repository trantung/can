@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Danh sách chi nhánh' }}
@stop

@section('content')

    <div class="row margin-bottom">
        <div class="col-xs-12">
            <a href="{{ action('BranchCategoryController@create') }}" class="btn btn-primary">Thêm mới chi nhánh</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh sách chi nhánh</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>STT</th>
                  <th>Tên chi nhánh</th>
                  <th>Địa chỉ</th>
                  <th>Chỉnh sửa lần cuối</th>
                  <th style="width:200px;">Action</th>
                </tr>
                @foreach($data as $key => $value)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $value->name }}</td>
                  <td>{{ $value->address }}</td>
                  <td>{{ $value->updated_at }}</td>
                  <td>
                    {{-- <a href="#" class="btn btn-success">Xem</a> --}}
                    {{-- <a href="{{action('BranchCategoryController@changePassword', $value->id) }}" class="btn btn-primary">Change Pass</a> --}}
                    <a href="{{ action('BranchCategoryController@edit', $value->id) }}" class="btn btn-primary">Sửa</a>
                    {{ Form::open(array('method'=>'DELETE', 'action' => array('BranchCategoryController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
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
