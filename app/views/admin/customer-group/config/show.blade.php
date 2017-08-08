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
                  <label for="module_id">Phone</label>
                  <div class="row">
                    <div class="col-sm-6">
                      {{ $data->customer_phone }}
                  </div>
                </div>
                <div class="form-group">
                  <label for="module_id">Địa chỉ</label>
                  <div class="row">
                    <div class="col-sm-6">
                      {{ $data->customer_address }}
                  </div>
                </div>
                <div class="form-group">
                  <label for="module_id">Fax</label>
                  <div class="row">
                    <div class="col-sm-6">
                      {{ $data->customer_fax }}
                  </div>
                </div>
                <div class="form-group">
                  <label for="module_id">Mã khách hàng</label>
                  <div class="row">
                    <div class="col-sm-6">
                      {{ $data->customer_code }}
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
