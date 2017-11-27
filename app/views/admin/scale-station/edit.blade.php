@extends('admin.layout.default')

@section('title')
{{ $title='Chỉnh sửa "'. $data->name .'"' }}
@stop

@section('content')
@include('admin.common.structure_company_css')
<div class="row margin-bottom">
    <div class="col-xs-12">
        <a href="{{ action('ScaleStationController@index') }}" class="btn btn-success">Danh sách</a>
        <a href="{{ action('ScaleStationController@create') }}" class="btn btn-primary">Thêm</a>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            {{ Form::open(array('action' => array('ScaleStationController@update', $data->id), 'method' => 'PUT')) }}
               <div class="box-body">
                <div class="form-group">
                  <label for="username">Mã trạm cân</label>
                  <div class="row">
                    <div class="col-sm-6">
                        {{ $data->code }}
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="username">Tên</label>
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
@include('admin.common.structure_company_js')
@stop
