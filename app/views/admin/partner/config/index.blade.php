@extends('admin.layout.default')
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
                  <th>Tên đối tác</th>
                  <th>Nhóm đối tác</th>
                  <th style="width:200px;">Gộp nhóm</th>
                </tr>
                @foreach($data as $key => $value)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ getDepartmentByScale($value->scale_code) }}</td>
                  <td>{{ $value->scale_code }}</td>
                  <td>{{ $value->doi_tac_ten }}</td>
                  <td>{{ getGroupByPartner($value->id) }}</td>
                  <td>
                    <a href="{{ action('ManagePartnerController@show', $value->id) }}" class="btn btn-primary">Show</a>
                    <a href="{{ action('ManagePartnerController@edit', $value->id) }}" class="btn btn-primary">Gộp</a>
                    {{ Form::open(array('method'=>'DELETE', 'action' => array('ManagePartnerController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
                    <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn bỏ gộp?');">Bỏ gộp</button>
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
