@extends('admin.layout.default')
@section('title')
{{ $title='Chỉnh sửa' }}
@stop

@section('content')

<div class="row margin-bottom">
  <div class="col-xs-12">
    <a href="{{ action('ConfigPropertyController@index') }}" class="btn btn-success">Danh sách</a>
  </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
        <!-- form start -->
        {{ Form::open(array('action' => array('ConfigPropertyController@update', $data->id), 'method' => 'PUT')) }}
          <div class="box-body">

            <div class="form-group">
              <label for="username">Chi nhánh</label>
              <div class="row">
                <div class="col-sm-6">
                  {{ Form::select('department_id', ['' => 'Chọn'] + Company::level(4)->lists('name', 'id'), $data->department_id,  array('class' => 'form-control', 'id' => 'department_id', 'disabled' => true))}}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Kho nguyên liệu</label>
              <div class="row">
                <div class="col-sm-6">
                  {{ Form::select('warehouse_id', ['' => 'Chọn'], $data->warehouse_id,  array('class' => 'form-control', 'id' => 'warehouse_id', 'disabled' => true))}}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Loại hàng</label>
              <div class="row">
                <div class="col-sm-6"> 
                  {{ Form::select('model_name', ['' => 'Chọn', 'ProductCategory' => 'Nguyên liệu thô', 'Product' => 'Thành phẩm'], $data->model_name,  array('class' => 'form-control', 'id' => 'model_name', 'disabled' => true))}}
                </div>
              </div>
            </div>
            <?php $model = $data->model_name; ?>
            <div class="form-group">
              <label for="username">Sản phẩm</label>
              <div class="row">
                <div class="col-sm-6">
                  {{ Form::select('model_id', ['' => 'Chọn'] + $model::lists('name', 'id'), $data->model_id,  array('class' => 'form-control', 'id' => 'model_id', 'disabled' => true))}}
                </div>
              </div>
            </div>
            @foreach ($data->data as $key => $value)
              
              <div class="form-group">
                <label for="username">{{ $key }}</label>
                <div class="row">
                  <div class="col-sm-6"> 
                    {{ Form::text('data[' . $key . ']', $value,  array('class' => 'form-control'))}}
                  </div>
                </div>

              </div>
            @endforeach
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