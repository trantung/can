@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Thống kế quá trình đóng bảo hiểm của nhân viên ' }}
@stop

@section('content')
<script type="text/javascript">
    $(document).ready(function(){
        $('#clear-search').click(function(){
            document.getElementById("searchForm").reset();
            $('.form-group :input').val('');
        });
    });
</script>
    <!-- inclue Search form -->
    {{-- @include('admin.manager.search') --}}
    <br>
    <div class="margin-bottom">
        <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <label>Mã nhân viên:</label>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                    NV{{$user->id}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <label>Họ tên:</label>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        {{$user->ho_ten}}
                    </div>
                </div>
            </div>
        </div>
        </div>

       <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <label>Từ ngày:</label>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                       {{$search['start_date'] != null ? date( "d-m-Y", strtotime($search['start_date'] ) ):'' }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <label>Đến ngày:</label>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                       {{ $search['end_date'] !=null ? date( "d-m-Y", strtotime($search['end_date'] ) ): '' }}
                    </div>
                </div>
            </div>
        </div>
        </div>

    </div>

    <div class="row">
        <div class="col-xs-12">
        <div class="box-header">
              <span class="pull-right"><b>{{$data->getTotal()}}</b> kết quả được tìm thấy</span>

            </div>
          <div class="box">

            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>#</th>
                  <th>Tháng</th>
                  <th>Năm</th>
                  <th>BHYT</th>
                  <th>BHXH</th>
                  <th>Tổng</th>
                </tr>
                @foreach($data as $key => $value)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{  $value->month }}</td>
                  <td>{{  $value->year }}</td>
                  <td>{{  number_format ($value->bhyt, 0, '', '.')}} </td>
                  <td>{{  number_format ($value->bhxh, 0, '', '.')}}</td>
                  <td>{{  number_format ($value->bhxh+$value->bhyt, 0, '', '.')}}</td>
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
     <div>
         <h4>Tổng cộng số tiền nhân viên {{$user->ho_ten}} đã đóng từ {{$search['start_date'] != null ? date( "d-m-Y", strtotime($search['start_date'] ) ):'--' }} đến {{ $search['end_date'] !=null ? date( "d-m-Y", strtotime($search['end_date'] ) ): '--' }} :<b> {{ number_format ($BHYT+$BHXH, 0, '', '.')}}  VNĐ</b></h4>
         <h5>Trong đó bao gồm</h5>
         <h4>- BHYT: <b>{{ number_format ($BHYT, 0, '', '.')}}  VNĐ</b></h4>
         <h4>- BHXH: <b>{{ number_format ($BHXH, 0, '', '.')}}  VNĐ</b></h4>
     </div>
@stop
@endif
