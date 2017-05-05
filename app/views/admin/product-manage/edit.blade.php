@extends('admin.layout.default')

@section('title')
{{ $title='Chỉnh sửa' }}
@stop

@section('content')


<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            {{ Form::open(array('action' => array('ProductManagerController@update', $data->id), 'method' => 'PUT')) }}
               <div class="box-body">
                <div class="form-group">
                  <label for="module_id">Sản phẩm</label>
                  <div class="row">
                    <div class="col-sm-6">
                      {{$data->name}}
                  </div>
                </div>
                <div class="form-group">
                  Nguyên liệu <span class="caret"></span>
                  @foreach($listProductCategory as $k => $val)
                  <div class="checkbox">
                    <label>
                      {{ Form::checkbox("product_category[$val->id]", 'true', isChecked('ProductManage', 'product_id', $data->id, 'product_category_id', $val->id) ) }}
                    {{ $val->name }}
                    </label>
                  </div>
                  @endforeach
                </div>
                Tỉ lệ hao hụt <span class="caret"></span>
                @foreach($listProductCategory as $k => $val)
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
