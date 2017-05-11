@extends('admin.layout.default')

@section('title')
{{ $title='Chỉnh sửa "'. $data->name .'"' }}
@stop

@section('content')

@if(Admin::isAdmin())
<div class="row margin-bottom">
    <div class="col-xs-12">
        <a href="{{ action('CompanyCategoryController@index') }}" class="btn btn-success">Cơ cấu tổ chức</a>
        <a href="{{ action('CompanyCategoryController@create') }}" class="btn btn-primary">Thêm </a>
    </div>
</div>
@endif

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            {{ Form::open(array('action' => array('CompanyCategoryController@update', $data->id), 'method' => 'PUT')) }}
               <div class="box-body">
                <div class="form-group">
                  <label for="username">Tên Cơ cấu tổ chức</label>
                  <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="name" placeholder="Tên Cơ cấu tổ chức" name="name" value="{{$data->name}}">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="username">Mã</label>
                  <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="code" placeholder="Mã" name="code" value="{{$data->code}}">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="name">Phân loại</label>
                  <div class="row">
                    <div class="col-sm-6">
                        {{ Form::select('level', $subTable['select'], $data->level ,array('class'=>'form-control')) }}
                    </div>
                  </div>
                </div>

                <div class="form-group">
              <label for="name">Parents</label>
              <div class="row">
                <div class="col-sm-6">
                    {{ Form::select('parent_id', $subTable['companyName'], $data->parent_id ,array('class'=>'form-control')) }}
                </div>
              </div>
            </div>
                <div class="form-group">
                  <label for="password">Địa chỉ</label>
                  <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="address" placeholder="Địa chỉ
                  " name="description" value="{{$data->description}}">
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
