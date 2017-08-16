@extends('admin.layout.default')
  @if(Admin::isAdmin())
@stop
@section('content')
@include('admin.common.structure_company_css')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
        <!-- form start -->
        {{ Form::open(array('action' => array('WarehouseController@postResetPercent', [$data->id, $listPercent->id]))) }}
          <div class="box-body">
            <div class="form-group">
              <label for="username">Khối lượng</label>
              <div class="row">
                <div class="col-sm-6">
                    {{ Form::text('weight', $data->weight, array('class' => 'form-control')) }}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Tỷ lệ độ khô(%)</label>
              <div class="row">
                <div class="col-sm-6">
                    {{ Form::text('do_kho', $listPercent->do_kho, array('class' => 'form-control')) }}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Tỷ lệ độ vỏ(%)</label>
              <div class="row">
                <div class="col-sm-6">
                    {{ Form::text('ty_le_vo', $listPercent->ty_le_vo, array('class' => 'form-control')) }}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Tỷ lệ tạp chất(%)</label>
              <div class="row">
                <div class="col-sm-6">
                    {{ Form::text('ty_le_tap_chat', $listPercent->ty_le_tap_chat, array('class' => 'form-control')) }}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Tỷ lệ quá cỡ(%)</label>
              <div class="row">
                <div class="col-sm-6">
                    {{ Form::text('ty_le_qua_co', $listPercent->ty_le_qua_co, array('class' => 'form-control')) }}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Tỷ lệ mùn(%)</label>
              <div class="row">
                <div class="col-sm-6">
                    {{ Form::text('ty_le_mun', $listPercent->ty_le_mun, array('class' => 'form-control')) }}
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
@endif