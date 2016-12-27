@extends('admin.layout.default')

@section('title')
{{ $title='Chỉnh sửa chi nhánh "'. $data->name .'"' }}
@stop

@section('content')

@if(Admin::isAdmin())
<div class="row margin-bottom">
    <div class="col-xs-12">
        <a href="{{ action('PositionCategoryController@index') }}" class="btn btn-success">Danh sách chi nhánh</a>
        <a href="{{ action('PositionCategoryController@create') }}" class="btn btn-primary">Thêm chi nhánh</a>
    </div>
</div>
@endif

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            {{ Form::open(array('action' => array('PositionCategoryController@update', $data->id), 'method' => 'PUT')) }}
               <div class="box-body">
                <div class="form-group">
                  <label for="username">Tên chi nhánh</label>
                  <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="name" placeholder="Tên chi nhánh" name="name" value="{{$data->name}}">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="branch_id">Chi nhánh</label>
                  <div class="row">
                    <div class="col-sm-6">
                        {{ Form::select('branch_category_id', $subTable, null, array('class'=>'form-control input-sm')) }}
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
