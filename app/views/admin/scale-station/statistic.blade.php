@extends('admin.layout.default')
@section('title')
{{ $title='Danh sách' }}
@stop

@section('content')
    <hr>
    <div class="row margin-bottom">
        <div class="col-xs-12">
            @include('admin.scale-station.template.search-scale')
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh sách</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>STT</th>
                  <th>Mã chiến dịch</th>
                  <th>Tên chiến dịch</th>
                  <th>Nhóm Khách hàng</th>
                  <th>Khách </th>
                  <th>Kho</th>
                  <th>Chi nhánh</th>
                  <th>KL hàng(kg)</th>
                  <th>Lượng trừ</th>
                  <th>Số chuyến</th>
                  <th>Tùy chọn</th>
                </tr>
                <?php $index = 1; ?>
                @foreach($data as $key => $value)
                <tr>
                  <td>{{ $index }}</td>
                  <td>{{ $value->campaign_code }}</td>
                  <td>{{ $value->campaign_name }}</td>
                  <td>{{ getCustomerGroup($value) }}</td>
                  <td>{{ $value->customer_name }}</td>
                  <td>{{ getNameWarehouse($value->warehouse_id) }}</td>
                  <td>{{ getNameCompany($value->department_id) }}</td>
                  <td>{{ number_format(getWeightTotalCampagin($value->campaign_code)) }}</td>
                  <td>{{ number_format(getLuongTruCampaign($value->campaign_code)) }}</td>
                  <td>{{ getSochuyen($value->campaign_code) }}</td>
                  <td>
                    <a href="{{ action('ScaleStationController@showDetail', $value->campaign_code) }}" class="btn btn-primary">Xem</a>
                  </td>
                </tr>
                <?php $index++; ?>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>

@stop
