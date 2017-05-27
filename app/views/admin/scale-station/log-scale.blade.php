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
                  <th>Kiểu sản phẩm</th>
                  <th>Vật phẩm</th>
                  <th>Kiểu cân</th>
                  <th>Kho</th>
                  <th>Chi nhánh</th>
                  <th>Mã chiến dịch</th>
                  <th>Id khách hàng</th>
                  <th>Ngày cân</th>
                  <th>Khối lượng hàng</th>
                  <th>App id</th>
                  <th>Mã</th>
                  <th style="width:200px;">Action</th>
                </tr>
                @foreach($data as $key => $value)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $value->number_ticket }}</td>
                  <td>{{ CommonNormal::getProductCategoryId($value->category_id)[1] }}</td>
                  <td>{{ CommonNormal::getProductCategoryId($value->category_id)[0] }}</td>
                  <td>{{ $value->transfer_type }}</td>
                  <td>{{ $value->warehouse_id }}</td>
                  <td>{{ $value->department_id }}</td>
                  <td>{{ $value->campaign_code }}</td>
                  <td>{{ $value->customer_id }}</td>
                  <td>{{ $value->scale_at }}</td>
                  <td>{{ $value->package_weight }}</td>
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
