@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Quá trình đóng bảo hiểm của nhân viên' }}
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
    <div class="margin-bottom">
        {{ Form::open(array('action' => 'InsuranceController@statistics', 'method' => 'GET', 'id'=>'searchForm')) }}
        <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <label>Mã hoặc tên nhân viên</label>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                    <input type="text" name="keyword" class="form-control" placeholder="Mã hoặc tên nhân viên" value="{{$search['keyword']}}" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <label>Tổ chức</label>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        {{ Form::select('incorporation', $company_category_id,$search['incorporation'] , array('class' =>'form-control')) }}
                    </div>
                </div>
            </div>
        </div>
        </div>

       <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <label>Từ ngày</label>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                       <input type="text" name="start_date" class="form-control" id="datepickerStartdate" placeholder=" / /" value="{{$search['start_date']}}" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <label>Đến ngày</label>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                       <input type="text" name="end_date" class="form-control" id="datepickerEnddate" placeholder=" / /" value="{{$search['end_date']}}" />
                    </div>
                </div>
            </div>
        </div>
        </div>

         <div class="row">
            <div class="col-md-12" style=" text-align: center;">
                <div class="form-group">
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>   Tìm kiếm nhân viên</button>
                <button type="button" class="btn btn-default" id="clear-search">Xóa bỏ</button>
                </div>
            </div>
        </div>

        {{ Form::close() }}
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
                  <th>Mã NV</th>
                  <th>Tên</th>
                  <th>Ngày đóng</th>
                  <th>BHYT</th>
                  <th>BHXH</th>
                  {{-- <th>Tháng</th> --}}
                  {{-- <th>Năm</th> --}}
                  {{-- <th>Ghi chú</th> --}}
                  <th style="width:200px;">Action</th>
                </tr>
                @foreach($data as $key => $value)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>NV{{  $value->user->id }}</td>
                  <td>{{  $value->user->ho_ten }}</td>
                  <td>{{date( "d-m-Y", strtotime( $value->pay_time ) ) }}</td>
                  <td>{{  number_format ($value->bhyt, 0, '', '.')}} </td>
                  <td>{{  number_format ($value->bhxh, 0, '', '.')}}</td>
               {{--    <td>{{ $value->month }}</td>
                  <td>{{ $value->year }}</td>
                  <td>{{ $value->description }}</td> --}}
                  <td>
                    <a href="{{ action('InsuranceController@edit', $value->id) }}" class="btn btn-primary">Xem</a>
                   {{--  <a href="{{ action('InsuranceController@edit', $value->id) }}" class="btn btn-primary">Sửa</a>
                    {{ Form::open(array('method'=>'DELETE', 'action' => array('InsuranceController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
                    <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
                    {{ Form::close() }} --}}

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
@endif
