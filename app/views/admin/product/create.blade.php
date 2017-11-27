@extends('admin.layout.default')
@section('title')
{{ $title='Thêm mới' }}
@stop

@section('content')

<div class="row margin-bottom">
  <div class="col-xs-12">
    <a href="{{ action('ProductController@index') }}" class="btn btn-success">Danh sách</a>
  </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
        <!-- form start -->
        {{ Form::open(array('action' => 'ProductController@store')) }}
          <div class="box-body">
            <div class="form-group">
              <label for="username">Mã thành phẩm</label>
              <div class="row">
                <div class="col-sm-6">
                  {{ getCodeAuto('TP', 'Product') }}
                   {{ Form::hidden('code', getCodeAuto('TP', 'Product')) }}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Tên</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="name" name="name" value="{{Input::old('name')}}">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Mô tả</label>
              <div class="row">
                <div class="col-sm-6">
                  <textarea class="form-control" rows="5" name="description"></textarea>
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
