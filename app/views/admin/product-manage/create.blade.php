@extends('admin.layout.default')
@section('title')
{{ $title='Cài đặt' }}
@stop

@section('content')

<div class="row margin-bottom">
  <div class="col-xs-12">
    <a href="{{ action('ProductManagerController@index') }}" class="btn btn-success">Danh sách</a>
  </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
        <!-- form start -->
        {{ Form::open(array('action' => 'ProductManagerController@store')) }}
          <div class="box-body">
            <div class="form-group">
              <label for="module_id">Nguyên liệu</label>
              <div class="row">
                <div class="col-sm-6">
                  <select class="form-control" name="product_category_id">
                      @foreach($listProductCategory as $key => $value)
                      <option value="{{ $value->id }}">{{ $value->name }}</option>
                      @endforeach
                    </select>
                </div>
              </div>
            </div>
            <div class="form-group">
               Thành phẩm <span class="caret"></span>
              @foreach($listProduct as $k => $val)
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="product[{{ $val->id }}]" value="true"> {{ $val->name }}
                </label>
              </div>
              @endforeach
            </div>
            Tỉ lệ hao hụt <span class="caret"></span>
            @foreach($listProduct as $k => $val)
              <div class="form-group">
                <label for="username">{{ $val->name }}</label>
                <div class="row">
                  <div class="col-sm-6">
                      <input type="text" class="form-control" name="ratio[{{ $val->id }}]">
                  </div>
                </div>
              </div>
            @endforeach
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