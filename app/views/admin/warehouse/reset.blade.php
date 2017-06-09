@extends('admin.layout.default')

@section('title')
{{ $title='Reset kho' }}
@stop

@section('content')


<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            {{ Form::open(array('action' => array('WarehouseController@putReset', $data->id), 'method' => 'PUT')) }}
               <div class="box-body">
                <div class="form-group">
                  <label for="username">Vật phẩm</label>
                  <div class="row">
                    <div class="col-sm-6">
                        {{ $data->item->name }}
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="username">Khối lượng</label>
                  <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="weight" name="weight" value="{{$data->weight}}">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="username">Tỷ lệ hao hụt</label>
                  <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="ratio" name="ratio" value="{{$data->ratio}}">
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
@include('admin.common.structure_company_js')
@stop
