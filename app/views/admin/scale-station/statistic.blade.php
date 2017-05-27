@extends('admin.layout.default')
@if(Admin::isAdmin())
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
                  <th>Số phiếu</th>
                  <th>Khách hàng</th>
                  <th>Tên hàng</th>
                  <th>Kho</th>
                  <th>Chi nhánh</th>
                  <th>Ngày cân</th>
                  <th>KL tổng(kg)</th>
                  <th>KL xe(kg)</th>
                  <th>KL hàng(kg)</th>
                  <th>KL tạp chất(kg)</th>
                  <th>Tỷ lệ tạp chất</th>
                  <th>Lượng trừ</th>
                </tr>
                @foreach($data as $key => $value)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $value->number_ticket }}</td>
                  <td>{{ $value->customer_name }}</td>
                  <td>
                  @if ($value->category_id != '')
                  <?php $modelName = CommonNormal::getNameProduct($value->category_id); ?>
                    {{ $modelName::find(CommonNormal::getProductCategoryId($value->category_id)[1])->name }}</td>
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
