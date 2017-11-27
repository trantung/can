@extends('admin.layout.default')

@section('title')
{{ $title='Chỉnh sửa "'. $data->name .'"' }}
@stop

@section('content')

<div class="row margin-bottom">
    <div class="col-xs-12">
        <a href="{{ action('ProductCategoryController@index') }}" class="btn btn-success">Danh sách</a>
        <a href="{{ action('ProductCategoryController@create') }}" class="btn btn-primary">Thêm</a>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            {{ Form::open(array('action' => array('ProductCategoryController@update', $data->id), 'method' => 'PUT')) }}
               <div class="box-body">
                <div class="form-group">
                  <label for="username">Mã nguyên liệu</label>
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
                  <label>Mô tả</label>
                  <div class="row">
                    <div class="col-sm-6">

                    {{ Form::textarea('description', $data->description, array('row' => 5, 'class' => 'form-control')) }}
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
