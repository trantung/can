@extends('admin.layout.default')

@section('title')
{{ $title='Chỉnh sửa nhóm đối tác "'. $data->name .'"' }}
@stop

@section('content')

@if(Admin::isAdmin())
<div class="row margin-bottom">
    <div class="col-xs-12">
        <a href="{{ action('PartnerController@index') }}" class="btn btn-success">Danh sách nhóm đối tác</a>
        <a href="{{ action('PartnerController@create') }}" class="btn btn-primary">Thêm nhóm đối tác</a>
    </div>
</div>
@endif

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            {{ Form::open(array('action' => array('PartnerController@update', $data->id), 'method' => 'PUT')) }}
               <div class="box-body">
                 <div class="form-group">
                  <label for="username">Mã nhóm đối tác</label>
                  <div class="row">
                    <div class="col-sm-6">
                      {{ getCodeAuto('NPT', 'PartnerGroup') }}
                      {{ Form::hidden('code', getCodeAuto('NPT', 'PartnerGroup')) }}
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="username">Tên đối tác</label>
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
