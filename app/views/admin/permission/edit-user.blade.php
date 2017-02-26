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
        {{ Form::open(array('action' => ['PermissionController@updateUser', $user->id])) }}
          <div class="box-body">
            <div class="form-group">
              <label for="username">User</label>
              <div class="row">
                <div class="col-sm-6">
                  {{ $user->username }}
                </div>
              </div>
            </div>

            <div class="form-group">
              <h2>Danh sách nhóm quyền trong hệ thống</h2>
              @foreach($listRole as $key => $value)
              <div class="checkbox">
                <label>
                  {{ Form::checkbox("role_id[$key]", true, getChecked($user->id, $key, 'RoleUser') ) }}
                    {{ $value }}
                </label>
              @endforeach
              </div>
            </div>

            @foreach($modules as $key => $value)
            <div class="form-group">
              {{ $value }} <span class="caret"></span>
                @foreach(Common::getPermissionByModule($key) as $k => $val)
                <div class="checkbox">
                  <label>
                    {{ Form::checkbox("permission[$k]", '1', checkBoxChecked($user->id, $k, 'PermissionUser', 'user_id') ) }}
                    {{ $val }}
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