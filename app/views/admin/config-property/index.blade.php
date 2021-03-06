@extends('admin.layout.default')
@section('title')
{{ $title='Danh sách' }}
@stop

@section('content')

    <div class="row margin-bottom">
        <div class="col-xs-12">
            <a href="{{ action('ConfigPropertyController@create') }}" class="btn btn-primary">Thêm mới</a>
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
                  <th>Kiểu sản phẩm</th>
                  <th>Tên</th>
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
                    @if ($value->model_name == 'ProductCategory')
                      {{ ProductCategory::find($value->model_id)->name }}
                    @else
                      {{ Product::find($value->model_id)->name }}
                    @endif
                   </td>
                  <td>
                    <a href="{{ action('ConfigPropertyController@edit', $value->id) }}" class="btn btn-primary">Sửa</a>
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
