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
        {{ Form::open(array('action' => ['PermissionController@updateUser', $id])) }}
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
              Nhóm quyền<span class="caret"></span>
              @foreach($listRole as $key => $value)
              <div class="checkbox">
                <label>
                  <!-- <input type="checkbox" name="role[{{$key}}]" value="{{ $key }}"> {{ $value}} -->
                  {{ Form::checkbox("role[$key]", true, getChecked($id, $key, null, 'RoleUser') ) }}
                    {{ $value }}
                </label>
              @endforeach
              </div>
            </div>

            @foreach($listPermission as $key => $value)
            <div class="form-group">
              {{ Module::find($key)->name }} <span class="caret"></span>
                @foreach($value as $k => $val)
                <div class="checkbox">
                  <label>
                    <?php $moduleId_permissionId = $key.'_'.$val->id; ?>
                    {{ Form::checkbox("permission[$moduleId_permissionId]", true, getChecked($id, null, $val->id, 'PermissionUser', $key) ) }} {{$val->name}}
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