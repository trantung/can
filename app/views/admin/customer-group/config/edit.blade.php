@extends('admin.layout.default')

@section('title')
{{ $title='Chỉnh sửa Khách hàng "'. $data->customer_name .'"' }}
@stop

@section('content')
<div class="row margin-bottom">
  <div class="col-xs-12">
    <a href="{{ action('ConfigCustomerController@index') }}" class="btn btn-success">Danh sách</a>
  </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            {{ Form::open(array('action' => array('ConfigCustomerController@update', $data->id), 'method' => 'PUT')) }}
               <div class="box-body">
                <div class="form-group">
                  <label for="module_id">Khách hàng</label>
                  <div class="row">
                    <div class="col-sm-6">
                      {{ $data->customer_name }}
                  </div>
                </div>
                <div class="form-group">
                  <label for="username">Lựa chọn nhóm khách hàng</label>
                  <div class="row">
                    <div class="col-sm-6">
                      {{ Form::select('customer_group_id',['' => 'Chọn']+ $listPersonal, $customerGroup, array('class' => 'form-control'))}}
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="module_id">Các khách hàng trong nhóm</label>
                  <label for="module_id">Tổng số khách hàng trong nhóm:</label>
                  <div class="row">
                    <div class="col-sm-6">
                      dùng ajax để lấy
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
