@extends('admin.layout.default')
@section('title')
{{ $title='Quản lý thành viên quản trị' }}
@stop

@section('content')

    <!-- inclue Search form -->
    @include('admin.manager.search')

    <div class="row margin-bottom">
        <div class="col-xs-12">
            <a href="{{ action('HumanResourcesController@create') }}" class="btn btn-primary">Thêm thành viên</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh sách thành viên</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>STT</th>
                  <th>Mã nhân viên</th>
                  <th>Tên nhân viên</th>
                  <th>Ngày sinh</th>
                  <th>Email</th>
                  <th>Điện thoại</th>
                  <th>Chi nhánh</th>
                  <th>Vị trí</th>
                  <th>Loại hợp đồng</th>
                  {{-- <th>Đăng nhập cuối</th> --}}
                  <th style="width:200px;">Action</th>
                </tr>
                @foreach($data as $key => $value)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $value->id_employees }}</td>
                  <td>{{ $value->fullname }}</td>
                  <td>{{ $value->birthday }}</td>
                  <td>{{ $value->mobile }}</td>
                  <td>{{ $value->email }}</td>
                  <td>{{ $branch_category_id[$value->branch_category_id] }}</td>
                  <td>{{ $position_category_id[$value->position_category_id] }}</td>
                  <td>{{ $employees_category_id[$value->employees_category_id] }}</td>
                  <td>
                    {{-- <a href="#" class="btn btn-success">Xem</a> --}}
                    {{-- <a href="{{action('HumanResourcesController@changePassword', $value->id) }}" class="btn btn-primary">Change Pass</a> --}}
                    <a href="{{ action('HumanResourcesController@edit', $value->id) }}" class="btn btn-primary">Sửa</a>
                    {{ Form::open(array('method'=>'DELETE', 'action' => array('HumanResourcesController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
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