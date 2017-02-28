@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Thêm mới chức vụ' }}
@stop

@section('content')

<div class="row margin-bottom">
  <div class="col-xs-12">
    <a href="{{ action('OfficerCategoryController@index') }}" class="btn btn-success">Danh sách chức vụ</a>
  </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
        <!-- form start -->
        {{ Form::open(array('action' => 'OfficerCategoryController@store')) }}
          <div class="box-body">
            <div class="form-group">
              <label for="username">Tên chức vụ</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="name" placeholder="Tên chức vụ" name="name" value="{{Input::old('name')}}">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="branch_id">Chức danh</label>
              <div class="row">
                <div class="col-sm-6">
                    {{ Form::select('position_id', $subTable, Input::old('position_id'), array('class'=>'form-control input-sm')) }}
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