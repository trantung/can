@extends('admin.layout.default')

@section('title')
{{ $title='Chỉnh sửa loại khen thưởng "'. $data->name .'"' }}
@stop

@section('content')

@if(Admin::isAdmin())
<div class="row margin-bottom">
    <div class="col-xs-12">
        <a href="{{ action('BonusCategoryController@index') }}" class="btn btn-success">Danh sách loại khen thưởng kỷ luật</a>
        <a href="{{ action('BonusCategoryController@create') }}" class="btn btn-primary">Thêm loại khen thưởng kỷ luật</a>
    </div>
</div>
@endif

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            {{ Form::open(array('action' => array('BonusCategoryController@update', $data->id), 'method' => 'PUT')) }}
               <div class="box-body">
                <div class="form-group">
                  <label for="username">Tên loại khen thưởng</label>
                  <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="name" placeholder="Tên loại khen thưởng" name="name" value="{{$data->name}}">
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
