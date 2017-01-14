@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Cơ cấu tổ chức'}}
@stop

@section('content')

    <div class="row margin-bottom">
        <div class="col-xs-12">
            <a href="{{ action('CompanyCategoryController@create') }}" class="btn btn-primary">Thêm mới </a>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Cơ cấu tổ chức</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="row">
                {{-- <div class="col-xs-1">{{ $key+1 }}</div> --}}
                <div class="col-xs-2">Tên</div>
                <div class="col-xs-2">Mã</div>
                <div class="col-xs-4">Mô tả</div>
                <div class="col-xs-1">
                 Action

                </div>
            </div>
                @include('admin.system.company.item', ['items'=>$data])
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            {{-- {{ $data->appends(Request::except('page'))->links() }} --}}
        </div>
    </div>

@stop
@endif
