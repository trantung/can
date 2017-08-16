@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Danh sách kho' }}
@stop

@section('content')

    <div class="row margin-bottom">
        <div class="col-xs-12">
            <a href="{{ action('WarehouseController@create') }}" class="btn btn-primary">Thêm mới kho</a>
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
                  <th>Tỷ lệ độ khô</th>
                  <th>Tỷ lệ vỏ</th>
                  <th>Tỷ lệ tạp chất</th>
                  <th>Tỷ lệ quá cỡ</th>
                  <th>Tỷ lệ mùn</th>
                  <th style="width:200px;">Action</th>
                </tr>
                @foreach($data as $key => $value)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $value->item->name }}</td>
                  <td>{{ $value->weight }}</td>
                  <td>{{ $value->ratio }}</td>
                  <td>{{ $value->ratio }}</td>
                  <td>{{ $value->ratio }}</td>
                  <td>{{ $value->ratio }}</td>
                  <td>{{ $value->ratio }}</td>
                  <td>
                    <a href="{{ action('WarehouseController@getReset', $value->id) }}" class="btn btn-primary">Reset kho</a>
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
