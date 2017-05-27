@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Danh sách' }}
@stop

@section('content')

    <div class="row margin-bottom">
        <div class="col-xs-12">
            <a href="{{ action('StorageLossController@create') }}" class="btn btn-primary">Thêm mới</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh sách </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>STT</th>
                  <th>Kiểu sản phẩm</th>
                  <th>Sản phẩm</th>
                  <th>Kho</th>
                  <th>Tỉ lệ</th>
                  <th style="width:200px;">Action</th>
                </tr>
                @foreach($data as $key => $value)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>
                    @if ($value->model_name == 'ProductCategory')
                      Nguyên liệu
                    @else
                      Thành phẩm
                    @endif
                  </td>
                  <td>
                    {{ Common::getNameByStorageLoss($value->model_name, $value->model_id) }}
                  </td>
                  <td>
                    @if ($warehouse = Warehouse::find($value->warehouse_id))
                      {{ $warehouse->name }}
                    @endif
                  </td>
                  <td>{{ $value->ratio }}</td>
                  <td>
                    <a href="{{ action('StorageLossController@edit', $value->id) }}" class="btn btn-primary">Sửa</a>
                    {{ Form::open(array('method'=>'DELETE', 'action' => array('StorageLossController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
                    <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
                    {{ Form::close() }}

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
