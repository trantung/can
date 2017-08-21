@extends('admin.layout.default')

@section('title')
{{ $title='Chỉnh sửa' }}
@stop

@section('content')


<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            {{ Form::open(['action' => ['ProductManagerController@update', $data->id], 'method' => 'PUT', 'class' => 'add-material-form']) }}
               <div class="box-body">
                <div class="form-group">
                  <label for="module_id"><h2>Nguyên liệu</h2></label>
                  <div class="row">
                    <div class="col-sm-6">
                      <h3>{{$data->name}}</h3> 
                    </div>
                  </div>
                </div>
                <div class="form-group add-material">
                  <label for="module_id"><h2>Thành phẩm</h2></label>
                  <div class="clearfix"></div>
                  Tỉ lệ hao hụt <span class=""></span>
                  @foreach($manageProduct as $key => $value)
                    <div class="add-multi-collapse">
                      <div class="form-collapse" id="1">
                        <div class="well form-inline clearfix">
                          <div class="form-group pull-left">
                            {{ Form::select('product[]', ['' => 'Chọn'] + $listProduct, $value->product_id, array('class' => 'form-control pull-left margin0', 'required' => true)) }}
                            {{ Form::text('ratio[]', $value->ratio, array('class' => 'form-control pull-left margin0', 'required' =>true)) }}
                          </div>
                          <button type="button" class="remove btn btn-default"><span class="glyphicon glyphicon-trash"></span></button>
                        </div>
                      </div>
                    </div>
                  @endforeach()
                  <button class="add-new-btn btn btn-primary" type="button" ><span class="glyphicon glyphicon-plus"></span>Thêm mới</button>
                </div>
               </div>
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
