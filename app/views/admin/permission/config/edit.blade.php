@extends('admin.layout.default')

@section('title')
{{ $title='Chỉnh sửa Chức danh "'. $data->name .'"' }}
@stop

@section('content')

@if(Admin::isAdmin())
<div class="row margin-bottom">
    <div class="col-xs-12">
        <a href="{{ action('ConfigPermissionController@index') }}" class="btn btn-success">Danh sách Chức danh</a>
        <a href="{{ action('ConfigPermissionController@create') }}" class="btn btn-primary">Thêm Chức danh </a>
    </div>
</div>
@endif

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            {{ Form::open(array('action' => array('ConfigPermissionController@update', $data->id), 'method' => 'PUT')) }}
               <div class="box-body">
                <div class="form-group">
                <label for="module_id">Module</label>
                <div class="row">
                  <div class="col-sm-6">
                  {{ Form::select('module_id', $subTable, $data->module_id, array('class'=>'form-control input-sm')) }}
                  </div>
                </div>
              </div>

                <div class="form-group">
                  <label for="username">Tên quyền</label>
                  <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="name" placeholder="Tên Chức danh" name="name" value="{{$data->name}}">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="username">Tên controller</label>
                  <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="controller_action" placeholder="Tên controller" name="controller_action" value="{{$data->controller_action}}">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="username">Tên action</label>
                  <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="action" placeholder="Tên action" name="action" value="{{$data->action}}">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="branch_id">Cơ cấu tổ chức</label>
                  <div class="row">
                    <div class="col-sm-6">
                        {{ Form::select('branch_category_id', $subTable, null, array('class'=>'form-control input-sm')) }}
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
