@extends('admin.layout.default')

@section('title')
{{ $title='Chỉnh sửa "'. $data->name .'"' }}
@stop

@section('content')

@if(Admin::isAdmin())
<div class="row margin-bottom">
    <div class="col-xs-12">
        <a href="{{ action('OverloadRatioController@index') }}" class="btn btn-success">Danh sách</a>
        <a href="{{ action('OverloadRatioController@create') }}" class="btn btn-primary">Thêm</a>
    </div>
</div>
@endif

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            {{ Form::open(array('action' => array('OverloadRatioController@update', $data->id), 'method' => 'PUT')) }}
               <div class="box-body">
                <div class="form-group">
              <label for="username">Loại hàng</label>
              <div class="row">
                <div class="col-sm-6"> 
                  {{ Form::select('model_name', ['' => 'Chọn', 'ProductCategory' => 'Nguyên liệu thô', 'Product' => 'Thành phẩm'], $data->model_name,  array('class' => 'form-control', 'id' => 'model_name'))}}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Sản phẩm</label>
              <div class="row">
                <div class="col-sm-6">
                  {{ Form::select('model_id', ['' => 'Chọn'], $data->model_id,  array('class' => 'form-control', 'id' => 'model_id'))}}
                </div>
              </div>
            </div>
            <?php $index = 0; ?>
            <div id="row-promotion">
              <div class="form-group config-data" data-row="<?= $index; ?>">
                <label for="username">Tên</label>
                <div class="row">
                  <div class="col-sm-6">
                      <input type="text" class="form-control" name="key[{{ $index }}]" value="{{Input::old('name')}}">
                  </div>
                  <div class="col-sm-6">
                      <input type="text" class="form-control" name="value[{{ $index }}]" value="{{Input::old('name')}}">
                  </div>
                </div>
              </div>
            </div>
            <a class="add-config btn btn-primary">Thêm</a>

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
