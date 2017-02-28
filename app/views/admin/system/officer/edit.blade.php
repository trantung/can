@extends('admin.layout.default')

@section('title')
{{ $title='Chỉnh sửa chức vụ "'. $data->name .'"' }}
@stop

@section('content')

@if(Admin::isAdmin())
<div class="row margin-bottom">
    <div class="col-xs-12">
        <a href="{{ action('OfficerCategoryController@index') }}" class="btn btn-success">Danh sách chức vụ</a>
        <a href="{{ action('OfficerCategoryController@create') }}" class="btn btn-primary">Thêm chức vụ</a>
    </div>
</div>
@endif

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            {{ Form::open(array('action' => array('OfficerCategoryController@update', $data->id), 'method' => 'PUT')) }}
               <div class="box-body">
                <div class="form-group">
                  <label for="username">Tên chức vụ</label>
                  <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="name" placeholder="Tên chức vụ" name="name" value="{{$data->name}}">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="branch_id">Chức danh</label>
                  <div class="row">
                    <div class="col-sm-6">
                        {{ Form::select('position_id', $subTable, $data->position_id, array('class'=>'form-control input-sm')) }}
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
