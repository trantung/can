@extends('admin.layout.default')

@section('title')
{{ $title='Xem "'. $data->name .'"' }}
@stop

@section('content')

@if(Admin::isAdmin())
<div class="row margin-bottom">
    <div class="col-xs-12">
        <a href="{{ action('ProductController@index') }}" class="btn btn-success">Danh sách</a>
    </div>
</div>
@endif
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
               <div class="box-body">
                <div class="form-group">
                  <label for="username">Mã thành phẩm</label>
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
                        {{ $data->name }}
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="username">Mô tả</label>
                  <div class="row">
                    <div class="col-sm-6">
                      {{ $data->description }}
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
              </div>
        </div>
        <!-- /.box -->
    </div>
</div>

@stop
