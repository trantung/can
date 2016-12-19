@extends('admin.layout.default')

@section('title')
{{ $title='Chỉnh sửa chi nhánh "'. $data->name .'"' }}
@stop

@section('content')

@if(Admin::isAdmin())
<div class="row margin-bottom">
    <div class="col-xs-12">
        <a href="{{ action('BranchCategoryController@index') }}" class="btn btn-success">Danh sách chi nhánh</a>
        <a href="{{ action('BranchCategoryController@create') }}" class="btn btn-primary">Thêm chi nhánh</a>
    </div>
</div>
@endif

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            {{ Form::open(array('action' => array('BranchCategoryController@update', $data->id), 'method' => 'PUT')) }}
               <div class="box-body">
                <div class="form-group">
                  <label for="username">Tên chi nhánh</label>
                  <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="name" placeholder="Tên chi nhánh" name="name" value="{{$data->name}}">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="password">Địa chỉ</label>
                  <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="address" placeholder="Địa chỉ
                  " name="address" value="{{$data->address}}">
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
