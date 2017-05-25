@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Danh sách' }}
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              @include('admin.scale-station.template.search')
              <table class="table table-hover">
                <tr>
                  <th>STT</th>
                  <th>Số phiếu</th>
                  <th>Tổng trọng lượng</th>
                  <th>Trọng lượng mùn</th>
                  <th>Trọng lượng quá cỡ</th>
                  <th>Trọng lượng vỏ</th>
                  <th>Trọng lượng tạp chất</th>
                  <th>Tỷ lệ mùn</th>
                  <th>Tỷ lệ quá cỡ</th>
                  <th>Tỷ lệ tạp chất</th>
                  <th>Tỷ lệ vỏ</th>
                  <th>Độ khô</th>
                  <th>Thời gian</th>
                  <th>App id</th>
                  <th>Mã</th>
                  <th style="width:200px;">Action</th>
                </tr>
                @foreach($data as $key => $value)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $value->number_ticket }}</td>
                  <td>{{ $value->weight_total }}</td>
                  <td>{{ $value->trong_luong_mun }}</td>
                  <td>{{ $value->trong_luong_qua_co }}</td>
                  <td>{{ $value->trong_luong_vo }}</td>
                  <td>{{ $value->trong_luong_tap_chat }}</td>
                  <td>{{ $value->ty_le_mun }}</td>
                  <td>{{ $value->ty_le_qua_co }}</td>
                  <td>{{ $value->ty_le_vo }}</td>
                  <td>{{ $value->ty_le_tap_chat }}</td>
                  <td>{{ $value->do_kho }}</td>
                  <td>{{ $value->created_at }}</td>
                  <td>{{ $value->app_id }}</td>
                  <td>{{ $value->code }}</td>
                  <td>
                    

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

    <div class="row">
        <div class="col-xs-12">
            {{ $data->appends(Request::except('page'))->links() }}
        </div>
    </div>

@stop
@endif
