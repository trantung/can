@extends('admin.layout.default')

@section('title')
{{ $title='Chỉnh sửa đối tác "'. $data->name .'"' }}
@stop

@section('content')

<div class="row margin-bottom">
    <div class="col-xs-12">
        <a href="{{ action('PartnerGroupController@index') }}" class="btn btn-success">Danh sách đối tác</a>
        <a href="{{ action('PartnerGroupController@create') }}" class="btn btn-primary">Thêm đối tác</a>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            {{ Form::open(array('action' => array('PartnerGroupController@update', $data->id), 'method' => 'PUT')) }}
               <div class="box-body">
                <div class="form-group">
                  <label for="username">Tên đối tác</label>
                  <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="name" name="name" value="{{$data->name}}">
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
