@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Danh sách' }}
@stop

@section('content')

    <div class="row margin-bottom">
        <div class="col-xs-12">
            <a href="{{ action('ProductionAutoController@create') }}" class="btn btn-primary">Thêm mới</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh sách sản xuất</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>STT</th>
                  <th>Mã phiếu</th>
                  <th>Kho nguyên liệu</th>
                  <th>Nguyên liệu</th>
                  <th>Thành phẩm</th>
                  <th>Hao hụt sản xuất</th>
                  <th>Hao hụt lưu kho</th>
                  <th>Trọng lượng nguyên liệu</th>
                  <th>Kho thành phẩm</th>
                  <th>Trọng lượng hàng</th>
                </tr>
                @foreach($data as $key => $value)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $value->code }}</td>
                  <td>{{ Warehouse::find($value->warehouse_id)->name }}</td>
                  <td>{{ ProductCategory::find($value->product_category_id)->name }}</td>
                  <td>{{ Product::find($value->product_id)->name }}</td>
                  <td>{{ $value->product_loss_id }}</td>
                  <td>{{ $value->storage_loss_id }}</td>
                  <td>{{ $value->product_category_weight }}</td>
                  <td>{{ Warehouse::find($value->warehouse_output_id)->name }}</td>
                  <td>{{ $value->product_weight }}</td>
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
