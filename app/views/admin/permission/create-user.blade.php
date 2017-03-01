@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Cài đặt quyền cho User' }}
@stop

@section('content')

<div class="row margin-bottom">
  <div class="col-xs-12">
    <a href="{{ action('PermissionController@index') }}" class="btn btn-success">Danh sách nhóm quyền</a>
  </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
        <!-- form start -->
        {{ Form::open(array('action' => 'PermissionController@storeUser')) }}
          <div class="box-body">
            <div class="form-group">
              <label for="username">User</label>
              <div class="row">
                <div class="col-sm-6">
                    <!-- <input type="text" class="form-control" id="name" placeholder="Tên nhóm quyền" name="name" value="{{Input::old('name')}}"> -->
                    <select class="form-control" name="user_id">
                      @foreach($listUser as $key => $value)
                      <option value="{{ $value->id }}">{{ $value->username }}</option>
                      @endforeach
                    </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <h2>Danh sách nhóm quyền trong hệ thống</h2>
              @foreach($listRole as $key => $value)
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="role_id[{{$key}}]" value="{{ $key }}"> {{ $value}}
                </label>
              @endforeach
              </div>
            </div>
            <hr>
            <h2>Danh sách chi tiết quyền trong hệ thống</h2>
            @foreach($modules as $key => $value)
            <div class="form-group">
              {{ $value }} <span class="caret"></span>
                @foreach(Common::getPermissionByModule($key) as $k => $val)
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="permission[{{ $k }}]"> {{ $val }}
                  </label>
                </div>
                @endforeach
            </div>
            @endforeach

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