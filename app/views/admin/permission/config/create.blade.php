@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Thêm mới quyền' }}
@stop

@section('content')

<div class="row margin-bottom">
  <div class="col-xs-12">
    <a href="{{ action('ConfigPermissionController@index') }}" class="btn btn-success">Danh sách Chức danh</a>
  </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
        <!-- form start -->
        {{ Form::open(array('action' => 'ConfigPermissionController@store')) }}
          <div class="box-body">
            <div class="form-group">
              <label for="module_id">Module</label>
              <div class="row">
                <div class="col-sm-6">
                {{ Form::select('module_id', $subTable, null, array('class'=>'form-control input-sm')) }}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Tên quyền</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="name" placeholder="Tên Chức danh" name="name" value="{{Input::old('name')}}">
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <label for="username">Tên controller</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="controller_action" placeholder="Tên controller" name="controller_action" value="{{Input::old('controller_action')}}">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="username">Tên action</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="action" placeholder="Tên action" name="action" value="{{Input::old('action')}}">
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