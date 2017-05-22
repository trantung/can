@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Thêm mới kho' }}
@stop

@section('content')

<div class="row margin-bottom">
  <div class="col-xs-12">
    <a href="{{ action('WarehouseController@index') }}" class="btn btn-success">Danh sách kho</a>
  </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
        <!-- form start -->
        {{ Form::open(array('action' => 'WarehouseController@store')) }}
          <div class="box-body">
            <div class="form-group">
              <label for="username">Tên kho</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="name" name="name" value="{{Input::old('name')}}">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="branch_id">Công ty</label>
              <div class="row">
                <div class="col-sm-6">
                    {{ Form::select('department_id', Common::getCompany(), Input::old('department_id'), array('class'=>'form-control input-sm')) }}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="branch_id">Chi nhánh</label>
              <div class="row">
                <div class="col-sm-6">
                    {{ Form::select('department_id', $subTable, Input::old('department_id'), array('class'=>'form-control input-sm')) }}
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