@extends('admin.layout.default')

@section('title')
{{ $title='Chỉnh sửa Khách hàng "'. $data->name .'"' }}
@stop

@section('content')

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
                      {{$data->name}}
                  </div>
                </div>
                <div class="form-group">
                  Danh sách <span class="caret"></span>
                  @foreach($listPersonal as $k => $val)
                  <div class="checkbox">
                    <label>
                      {{ Form::checkbox("list_customer[$val->id]", 'true', isChecked('CustomerManage', 'customer_group_id', $data->id, 'customer_id', $val->customer_id) ) }}
                    {{ $val->customer_name }}
                    </label>
                  </div>
                  @endforeach
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
