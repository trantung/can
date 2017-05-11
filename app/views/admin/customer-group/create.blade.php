@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Thêm mới khách hàng' }}
@stop

@section('content')

<div class="row margin-bottom">
  <div class="col-xs-12">
    <a href="{{ action('CustomerGroupController@index') }}" class="btn btn-success">Danh sách khách hàng</a>
  </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
        <!-- form start -->
        {{ Form::open(array('action' => 'CustomerGroupController@store')) }}
          <div class="box-body">
            <div class="form-group">
              <label for="username">Tên khách hàng</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="name" name="name" value="{{Input::old('name')}}">
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