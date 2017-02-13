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
               <div class="box-body">
                <div class="form-group">
                  <label for="username">Tên Cơ cấu tổ chức</label>
                  <div class="row">
                    <div class="col-sm-6">
                        {{$data->name}}
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="username">Mã</label>
                  <div class="row">
                    <div class="col-sm-6">
                        {{$data->code}}
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="name">Phân loại</label>
                  <div class="row">
                    <div class="col-sm-6">
                    {{ $subTable['select'][$data->level]}}
                    </div>
                  </div>
                </div>

                <div class="form-group">
              <label for="name">Parents</label>
              <div class="row">
                <div class="col-sm-6">
                {{$data->parent_id ? $subTable['companyName'][$data->parent_id]: ""}}
                </div>
              </div>
            </div>
                <div class="form-group">
                  <label for="password">Địa chỉ</label>
                  <div class="row">
                    <div class="col-sm-6">
                        {{$data->description}}
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>

@stop
