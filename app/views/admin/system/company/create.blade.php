@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Thêm mới Cơ cấu tổ chức' }}
@stop

@section('content')

<div class="row margin-bottom">
  <div class="col-xs-12">
    <a href="{{ action('CompanyCategoryController@index') }}" class="btn btn-success">Cơ cấu tổ chức</a>
  </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
        <!-- form start -->
        {{ Form::open(array('action' => 'CompanyCategoryController@store')) }}
          <div class="box-body">
            <div class="form-group">
              <label for="username">Tên Cơ cấu tổ chức</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="name" placeholder="Tên Cơ cấu tổ chức" name="name" value="{{Input::old('name')}}">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Mã</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="code" placeholder="Mã" name="code" value="{{Input::old('code')}}">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="name">Phân loại</label>
              <div class="row">
                <div class="col-sm-6">
                    {{ Form::select('level', $subTable['select'], null ,array('class'=>'form-control')) }}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="name">Parents</label>
              <div class="row">
                <div class="col-sm-6">
                    {{ Form::select('parent_id', $subTable['companyName'], null ,array('class'=>'form-control')) }}
                </div>
              </div>
            </div>


            <div class="form-group">
              <label for="password">Địa chỉ</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="address" placeholder="Địa chỉ
              " name="description" value="{{Input::old('description')}}">
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