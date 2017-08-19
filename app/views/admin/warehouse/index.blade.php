@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Danh sách kho' }}
@stop

@section('content')
@include('admin.warehouse.search')
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
                  <th>Mã kho</th>
                  <th>Tên kho</th>
                  <th>Chi nhánh</th>
                  <th>Level</th>
                  <th style="width:300px;">Action</th>
                </tr>
                @foreach($data as $key => $value)
                @if ($level = CompanyCategoryLevel::find($value->department->level))
                  <?php $nameLevel = $level->name; ?>
                @else
                  <?php $nameLevel = 'Không xác định'; ?>
                @endif
                

                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $value->code }}</td>
                  <td>{{ $value->name }}</td>
                   <td>{{ $value->department <> null ?  $value->department->name : ''}}</td>
                   <td>{{ $nameLevel }}</td>
                  <td>
                    <a href="{{ action('WarehouseController@getStatistic', $value->id) }}" class="btn btn-primary">Thống kê</a>
                    <!-- <a href="{{ action('WarehouseController@getReset', $value->id) }}" class="btn btn-primary">Reset</a> -->
                    <!-- <a href="{{ action('ScaleStationController@getPercent', $value->id) }}" class="btn btn-primary">Phần trăm</a> -->
                    <a href="{{ action('WarehouseController@edit', $value->id) }}" class="btn btn-primary">Sửa</a>
                    {{ Form::open(array('method'=>'DELETE', 'action' => array('WarehouseController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
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
