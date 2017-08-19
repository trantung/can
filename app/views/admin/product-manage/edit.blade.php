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
                  <label for="module_id">Nguyên liệu</label>
                  <div class="row">
                    <div class="col-sm-6">
                      {{$data->name}} 
                  </div>
                </div>
                <div class="form-group add-material">
                  Thành phẩm <span class="caret"></span><br/><br/>
                  <div class="clearfix"></div>
                  Tỉ lệ hao hụt <span class="caret"></span>
                  <div class="add-multi-collapse">
                    <div class="form-collapse" id="1">
                      <div class="well form-inline clearfix">
                        <div class="form-group pull-left">
                          {{ Form::select('product[]', ['' => 'Chọn'] + $listProduct, '', array('class' => 'form-control pull-left margin0', 'required' => true)) }}
                          <input type="text" size="50" class="form-control pull-left margin0" name="ratio[]" required="">
                        </div>
                        <button type="button" class="remove btn btn-default"><span class="glyphicon glyphicon-trash"></span></button>
                      </div>
                    </div>
                  </div>
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
