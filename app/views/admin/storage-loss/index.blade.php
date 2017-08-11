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
                  <th>Id</th>
                  <th>Kho</th>
                  <th>Chi nhánh</th>
                  <th>Level</th>
                  <th>Hao hụt lưu kho</th>
                  <th style="width:200px;">Action</th>
                </tr>
                @foreach($data as $key => $value)
                  @if ($level = CompanyCategoryLevel::find($value->department->level))
                    <?php $nameLevel = $level->name; ?>
                  @else
                    <?php $nameLevel = 'Không xác định'; ?>
                  @endif
                <tr>
                  <td>{{ $value->id }}</td>
                  <td>
                    {{ getNameWarehouse($value->id) }}
                  </td>
                  <td>{{ $value->department <> null ?  $value->department->name : ''}}</td>
                  <td>{{ $nameLevel }}</td>
                  <td>{{ getDetailStorageLossSave($value->id) }}</td>
                  <td>
                    <a href="{{ action('StorageLossController@edit', $value->id) }}" class="btn btn-primary">Sửa</a>
                    {{ Form::open(array('method'=>'POST', 'action' => array('StorageLossController@reset', $value->id), 'style' => 'display: inline-block;')) }}
                    <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn reset hao hụt lưu kho?');">Reset</button>
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
