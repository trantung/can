@extends('admin.layout.default')

@section('title')
{{ $title='Chỉnh sửa đối tác "'. $data->customer_name .'"' }}
@stop

@section('content')
<div class="row margin-bottom">
  <div class="col-xs-12">
    <a href="{{ action('ManagePartnerController@index') }}" class="btn btn-success">Danh sách</a>
  </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            {{ Form::open(array('action' => array('ManagePartnerController@update', $data->id), 'method' => 'PUT')) }}
               <div class="box-body">
                <div class="form-group">
                  <label for="module_id">đối tác</label>
                  <div class="row">
                    <div class="col-sm-6">
                      {{ $data->doi_tac_ten }}
                  </div>
                </div>
                <div class="form-group">
                  <label for="module_id">Phone</label>
                  <div class="row">
                    <div class="col-sm-6">
                      {{ $data->doi_tac_sdt }}
                  </div>
                </div>
                <div class="form-group">
                  <label for="module_id">Địa chỉ</label>
                  <div class="row">
                    <div class="col-sm-6">
                      {{ $data->doi_tac_dia_chi }}
                  </div>
                </div>
                <div class="form-group">
                  <label for="module_id">Fax</label>
                  <div class="row">
                    <div class="col-sm-6">
                      {{ $data->doi_tac_fax }}
                  </div>
                </div>
                <div class="form-group">
                  <label for="module_id">Mã đối tác</label>
                  <div class="row">
                    <div class="col-sm-6">
                      {{ $data->partner_id }}
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
