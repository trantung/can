@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Thêm mới Dân tộc' }}
@stop

@section('content')

<div class="row margin-bottom">
  <div class="col-xs-12">
    <a href="{{ action('EthnicCategoryController@index') }}" class="btn btn-success">Danh sách Dân tộc</a>
  </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
        <!-- form start -->
        {{ Form::open(array('action' => 'EthnicCategoryController@store')) }}
          <div class="box-body">
            <div class="form-group">
              <label for="username">Tên Dân tộc</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="name" placeholder="Tên Dân tộc" name="name" value="{{Input::old('name')}}">
                </div>
              </div>
            </div>
            <div class="form-group">
                  <label for="description">Diễn giải</label>
                  <div class="row">
                    <div class="col-sm-6">
                        {{ Form::textarea('description', 'Diễn giải', array('class'=>'form-control input-sm')) }}
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
@endif