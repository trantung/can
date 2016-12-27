@extends('admin.layout.default')
@section('title')
{{ $title='Thêm mới Quốc gia vùng lãnh thổ' }}
@stop

@section('content')

<div class="row margin-bottom">
  <div class="col-xs-12">
    <a href="{{ action('NationalityCategoryController@index') }}" class="btn btn-success">Danh sách Quốc gia vùng lãnh thổ</a>
  </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
        <!-- form start -->
        {{ Form::open(array('action' => 'NationalityCategoryController@store')) }}
          <div class="box-body">
            <div class="form-group">
              <label for="username">Tên Quốc gia vùng lãnh thổ</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="name" placeholder="Tên Quốc gia vùng lãnh thổ" name="name" value="{{Input::old('name')}}">
                </div>
              </div>
            </div>
            <div class="form-group">
                  <label for="description">Diễn giải</label>
                  <div class="row">
                    <div class="col-sm-6">
                        {{ Form::textarea('description', 'Diễn giải', array('class'=>'form-control input-sm')) }}
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