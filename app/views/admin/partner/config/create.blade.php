@extends('admin.layout.default')
@section('title')
{{ $title='Cài đặt' }}
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
        {{ Form::open(array('action' => 'ManagePartnerController@store')) }}
          <div class="box-body">
            <div class="form-group">
              <label for="module_id">User</label>
              <div class="row">
                <div class="col-sm-6">
                  <select class="form-control" name="user_id">
                      @foreach($listUser as $key => $value)
                      <option value="{{ $value->id }}">{{ $value->username }}</option>
                      @endforeach
                    </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              Nhân viên <span class="caret"></span>
              @foreach($listPersonal as $k => $val)
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="personal[{{ $k }}]" value="true"> {{ $val->ho_ten }}
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
@endif