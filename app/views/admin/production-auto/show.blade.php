@extends('admin.layout.default')
@section('title')
{{ $title='Thêm mới' }}
@stop

@section('content')

<div class="row margin-bottom">
  <div class="col-xs-12">
    <a href="{{ action('ProductionAutoController@index') }}" class="btn btn-success">Danh sách</a>
  </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
        <!-- form start -->
          <div class="box-body">
            <div class="form-group">
              <label for="username">Chi nhánh</label>
              <div class="row">
                <div class="col-sm-6">
                  {{ Form::select('department_id', ['' => 'Chọn'] + Company::level(3)->lists('name', 'id'), $input['department_id'],  array('class' => 'form-control'))}}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Kho</label>
              <div class="row">
                <div class="col-sm-6">
                  {{ Form::select('warehouse_id', ['' => 'Chọn'], null,  array('class' => 'form-control', 'id' => 'warehouse_id'))}}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Nguyên liệu</label>
              <div class="row">
                <div class="col-sm-6">
                  {{ Form::select('product_category_id', ['' => 'Chọn'] + ProductCategory::lists('name', 'id'), null,  array('class' => 'form-control', 'id' => 'department_id'))}}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Thành phẩm</label>
              <div class="row">
                <div class="col-sm-6">
                  {{ Form::select('product_id', ['' => 'Chọn'] + Product::lists('name', 'id'), null,  array('class' => 'form-control', 'id' => 'department_id'))}}
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="username">Khối lượng nguyên liệu</label>
              <div class="row">
                <div class="col-sm-6">
                  {{ Form::text('product_category_weight', null,  array('class' => 'form-control'))}}
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <input type="submit" class="btn btn-primary" value="Lưu lại" />
            <input type="reset" class="btn btn-default" value="Nhập lại" />
          </div>
      </div>
      <!-- /.box -->
    </div>
</div>

@stop
