@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Danh sách' }}
@stop

@section('content')

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
                  <th>Chi nhánh</th>
                  <th>Trạm cân</th>
                  <th>Tên khách hàng</th>
                  <th>Nhóm khách hàng</th>
                  <th style="width:200px;">Gộp nhóm</th>
                </tr>
                @foreach($data as $key => $value)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ getDepartmentByScale($value->scale_code) }}</td>
                  <td>{{ $value->scale_code }}</td>
                  <td>{{ $value->customer_name }}</td>
                  <td>{{ getGroupByCustomer($value->id) }}</td>
                  <td>
                    <a href="{{ action('ConfigCustomerController@edit', $value->id) }}" class="btn btn-primary">Gộp</a>
                    {{ Form::open(array('method'=>'DELETE', 'action' => array('ConfigCustomerController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
                    <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Bỏ gộp</button>
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

@stop
@endif
