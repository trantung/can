@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Thêm mới chi nhánh' }}
@stop

@section('content')

<div class="row margin-bottom">
  <div class="col-xs-12">
    <a href="{{ action('BranchCategoryController@index') }}" class="btn btn-success">Danh sách chi nhánh</a>
  </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
        <!-- form start -->
        {{ Form::open(array('action' => 'BranchCategoryController@store')) }}
          <div class="box-body">
            <div class="form-group">
              <label for="username">Tên chi nhánh</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="name" placeholder="Tên chi nhánh" name="name" value="{{Input::old('name')}}">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="password">Địa chỉ</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="address" placeholder="Địa chỉ
              " name="address" value="{{Input::old('address')}}">
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