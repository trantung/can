@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Thêm mới nhóm đối tác' }}
@stop

@section('content')

<div class="row margin-bottom">
  <div class="col-xs-12">
    <a href="{{ action('PartnerController@index') }}" class="btn btn-success">Danh sách nhóm đối tác</a>
  </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
        <!-- form start -->
        {{ Form::open(array('action' => 'PartnerController@store')) }}
          <div class="box-body">
            <div class="form-group">
              <label for="username">Mã nhóm đối tác</label>
              <div class="row">
                <div class="col-sm-6">
                  {{ getCodeAuto('NPT', 'CustomerGroup') }}
                  {{ Form::hidden('code', getCodeAuto('NPT', 'PartnerGroup')) }}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Tên nhóm đối tác</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="name" name="name" value="{{Input::old('name')}}">
                </div>
              </div>
            </div>  
            <div class="form-group">
              <label for="username">Mô tả</label>
              <div class="row">
                <div class="col-sm-6">
                {{ Form::textarea('description', null, array('row' => 5, 'class' => 'form-control')) }}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Số điện thoại</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="phone" name="phone" value="{{Input::old('phone')}}">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Fax</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="fax" name="fax" value="{{Input::old('fax')}}">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Email</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="email" name="email" value="{{Input::old('email')}}">
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