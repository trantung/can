@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Thêm mới nhóm quyền' }}
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
        {{ Form::open(array('action' => ['PermissionController@updateRole', $id])) }}
          <div class="box-body">
            <div class="form-group">
              <label for="username">Tên nhóm quyền</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="name" placeholder="Tên nhóm quyền" name="name" value="{{Input::old('name')}}">
                </div>
              </div>
            </div>
            @foreach($listRole as $key => $value)
            <div class="form-group">
              {{ Module::find($key)->name }} <span class="caret"></span>
                @foreach($value as $k => $val)
                <div class="checkbox">
                  <label>
                  <?php $moduleId_permissionId = $key.'_'.$val->id; ?>
                    {{ Form::checkbox("permission[$moduleId_permissionId]", '1', checkBoxChecked($id, $key, $val->id, 'ModuleRolePermission') ) }}
                    {{ $val->name }}
                  </label>
                </div>
                @endforeach
            </div>
            @endforeach
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