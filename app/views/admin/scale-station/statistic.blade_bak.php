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
                  <td>{{ $value->number_ticket }}</td>
                  <td>{{ $value->customer_name }}</td>
                  <td>
                  <?php $modelName = CommonNormal::getNameProduct($value->category_id);
                  $product = $modelName::find(CommonNormal::getProductCategoryId($value->category_id)[0]);
                  ?>
                  @if ($value->category_id != '' && $product )
                    {{ $product->name }}
                  @endif
                  </td>
                  
                  <td>
                  @if ($warehouse = Warehouse::find($value->warehouse_id))
                    {{ $warehouse->name }}
                  @endif
                  </td>
                  <td>
                  @if ($department = Company::find($value->department_id))
                    {{ $department->name }}
                  @endif
                  </td>
                  <td>{{ $value->scale_at }}</td>
                  <td>{{ $value->first_scale_weight }}</td>
                  <td>{{ $value->second_scale_weight }}</td>
                  <td>{{ $value->package_weight }}</td>
                  <td>{{ $value->trong_luong_tap_chat }}</td>
                  <td>{{ $value->ty_le_tap_chat }}</td>
                  <td>
                  @if ($luongTru = LuongTruCan::where('ma_phieu_can', $value->number_ticket)->first())
                    {{ $luongTru->luongtru }}
                  @endif
                  </td>
                  <td>
                    <a href="{{ action('ScaleStationController@getDetail', $value->number_ticket) }}" class="btn btn-primary">Xem</a>
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
@endif
