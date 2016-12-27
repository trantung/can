@extends('admin.layout.default')

@section('title')
{{ $title='Chỉnh sửa Tôn giáo "'. $data->name .'"' }}
@stop

@section('content')

@if(Admin::isAdmin())
<div class="row margin-bottom">
    <div class="col-xs-12">
        <a href="{{ action('ReligionCategoryController@index') }}" class="btn btn-success">Danh sách Tôn giáo</a>
        <a href="{{ action('ReligionCategoryController@create') }}" class="btn btn-primary">Thêm Tôn giáo</a>
    </div>
</div>
@endif

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            {{ Form::open(array('action' => array('ReligionCategoryController@update', $data->id), 'method' => 'PUT')) }}
               <div class="box-body">
                <div class="form-group">
                  <label for="username">Tên Tôn giáo</label>
                  <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="name" placeholder="Tên Tôn giáo" name="name" value="{{$data->name}}">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                   <label for="description">Diễn giải</label>
                  <div class="row">
                    <div class="col-sm-6">
                        {{ Form::textarea('description', $data->description, array('class'=>'form-control input-sm')) }}
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
