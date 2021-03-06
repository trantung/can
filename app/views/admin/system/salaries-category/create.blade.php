@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Thêm mới Kiểu lương' }}
@stop

@section('content')

<div class="row margin-bottom">
  <div class="col-xs-12">
    <a href="{{ action('SalariesCategoryController@index') }}" class="btn btn-success">Danh sách Kiểu lương</a>
  </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
        <!-- form start -->
        {{ Form::open(array('action' => 'SalariesCategoryController@store')) }}
          <div class="box-body">
            <div class="form-group">
              <label for="username">Tên Kiểu lương</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="name" placeholder="Tên Kiểu lương" name="name" value="{{Input::old('name')}}">
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