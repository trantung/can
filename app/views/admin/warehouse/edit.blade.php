@extends('admin.layout.default')

@section('title')
{{ $title='Chỉnh sửa kho "'. $data->name .'"' }}
@stop

@section('content')
<link rel="stylesheet" type="text/css" href="/assets/js/combotree/themes/metro/easyui.css">
<link rel="stylesheet" type="text/css" href="/assets/js/combotree/themes/icon.css">
<link rel="stylesheet" type="text/css" href="/assets/js/combotree/demo/demo.css">
@if(Admin::isAdmin())
<div class="row margin-bottom">
    <div class="col-xs-12">
        <a href="{{ action('WarehouseController@index') }}" class="btn btn-success">Danh sách kho</a>
        <a href="{{ action('WarehouseController@create') }}" class="btn btn-primary">Thêm kho</a>
    </div>
</div>
@endif

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            {{ Form::open(array('action' => array('WarehouseController@update', $data->id), 'method' => 'PUT')) }}
               <div class="box-body">
                <div class="form-group">
                  <label for="username">Mã số kho</label>
                  <div class="row">
                    <div class="col-sm-6">
                        {{ $data->code }}
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="username">Tên kho</label>
                  <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="name" name="name" value="{{$data->name}}">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="branch_id">Chi nhánh</label>
                  <div class="row">
                    <div class="col-sm-6">

                        <input name="department_id" class="easyui-combotree" data-options="url:'/admin/jstree',method:'get'" style="width:100%" value="{{ $data->department_id }}">
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
<script type="text/javascript" src="/assets/js/combotree/jquery.easyui.min.js"></script>
@stop
