@extends('admin.layout.default')

@section('title')
{{ $title='Chỉnh sửa nhóm khách hàng "'. $data->name .'"' }}
@stop

@section('content')

@if(Admin::isAdmin())
<div class="row margin-bottom">
    <div class="col-xs-12">
        <a href="{{ action('CustomerGroupController@index') }}" class="btn btn-success">Danh sách nhóm khách hàng</a>
        <a href="{{ action('CustomerGroupController@create') }}" class="btn btn-primary">Thêm nhóm khách hàng</a>
    </div>
</div>
@endif

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            {{ Form::open(array('action' => array('CustomerGroupController@update', $data->id), 'method' => 'PUT')) }}
               <div class="box-body">
                 <div class="form-group">
                  <label for="username">Mã nhóm khách hàng</label>
                  <div class="row">
                    <div class="col-sm-6">
                      {{ getCodeAuto('NKH', 'CustomerGroup') }}
                      {{ Form::hidden('code', getCodeAuto('NKH', 'CustomerGroup')) }}
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="username">Tên khách hàng</label>
                  <div class="row">
                    <div class="col-sm-6">
                        <input type="text" rows="5" class="form-control" id="name" name="name" value="{{$data->name}}">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="username">Mô tả</label>
                  <div class="row">
                    <div class="col-sm-6">
                        {{ Form::textarea('description', $data->description, array('row' => 5, 'class' => 'form-control')) }}
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="username">Số điện thoại</label>
                  <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="phone" name="phone" value="{{$data->phone}}">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="username">Fax</label>
                  <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="fax" name="fax" value="{{$data->fax}}">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="username">Email</label>
                  <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="email" name="email" value="{{$data->email}}">
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
