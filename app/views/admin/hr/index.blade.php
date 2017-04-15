@extends('admin.layout.default')
@section('title')
{{ $title='Quản lý nhân sự' }}
@stop

@section('content')
<script type="text/javascript">
    $(document).ready(function(){
        document.cookie = "activeMenu=child-hr";
    });
</script>
<hr>
    <!-- inclue Search form -->
    @include('admin.hr.template.search')
<hr>
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
              <span class="pull-right"><b>{{$data->getTotal()}}</b> kết quả được tìm thấy</span>

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>STT</th>
                  <th>Mã nhân viên</th>
                  <th>Tên nhân viên</th>
                  <th>Ngày sinh</th>
                  <th>Vị trí công tác chính</th>
                  <th>Chức vụ</th>
                  <th style="width:200px;">Action</th>
                </tr>
                @foreach($data as $key => $value)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>NV{{ $value->id }}</td>
                  <td>{{ $value->ho_ten }}</td>
                  <td>{{ date( "d-m-Y", strtotime( $value->nam_sinh ) ) }}</td>
                  <td>{{ $value->employment_main_position != null ? $value->employment_main_position->company_name_text : '' }}</td>
                  <td>
                  @if($value->employment_main_position <> null)
                  @if(isset($position_category_id[$value->employment_main_position->position]))
                    {{$position_category_id[$value->employment_main_position->position]}}
                  @endif
                  @endif</td>
                  <td>
                    <a href="{{ action('HumanResourcesController@edit', $value->id) }}" class="btn btn-primary">Sửa</a>
                    <a href="{{ action('HumanResourcesController@show', $value->id) }}" class="btn btn-primary">Xem</a>
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

    @include('admin.common.paginate',['input'=>$data])

@stop