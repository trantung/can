@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Danh sách kho' }}
@stop

@section('content')
    <div class="row margin-bottom">
      <div class="col-xs-12">
        <a href="{{ action('WarehouseController@index') }}" class="btn btn-success">Danh sách kho</a>
      </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh sách kho</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>STT</th>
                  <th>Tên thể loại</th>
                  <th>Khối lượng</th>
                  <th>Tỷ lệ độ khô(%)</th>
                  <th>Tỷ lệ vỏ(%)</th>
                  <th>Tỷ lệ tạp chất(%)</th>
                  <th>Tỷ lệ quá cỡ(%)</th>
                  <th>Tỷ lệ mùn(%)</th>
                  <th style="width:200px;">Action</th>
                </tr>
                @foreach($data as $key => $value)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ getNameProductOrCategory($value) }}</td>
                  <td>{{ numberFormat($value->weight, 'tấn') }}</td>
                  <td>{{ getStaticPercentWarehouse($value, 'do_kho') }}</td>
                  <td>{{ getStaticPercentWarehouse($value, 'ty_le_vo') }}</td>
                  <td>{{ getStaticPercentWarehouse($value, 'ty_le_tap_chat') }}</td>
                  <td>{{ getStaticPercentWarehouse($value, 'ty_le_qua_co') }}</td>
                  <td>{{ getStaticPercentWarehouse($value, 'ty_le_mun') }}</td>
                  <td>
                    <a href="{{ action('WarehouseController@getReset', $value->id) }}" class="btn btn-primary">Tịnh kho</a>
                  </td>
                </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>

@stop
@endif
