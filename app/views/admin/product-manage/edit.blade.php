@extends('admin.layout.default')

@section('title')
{{ $title='Chỉnh sửa User "'. $data->username .'"' }}
@stop

@section('content')


<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            {{ Form::open(array('action' => array('ProductManagerController@update', $data->id), 'method' => 'PUT')) }}
               <div class="box-body">
                <div class="form-group">
                  <label for="module_id">User</label>
                  <div class="row">
                    <div class="col-sm-6">
                      {{$data->username}}
                  </div>
                </div>
                <div class="form-group">
                  Nhân viên <span class="caret"></span>
                  @foreach($listPersonal as $k => $val)
                  <div class="checkbox">
                    <label>
                      {{ Form::checkbox("personal[$val->id]", 'true', isChecked('UserPersonal', 'user_id', $data->id, 'personal_id', $val->id) ) }}
                    {{ $val->ho_ten }}
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
