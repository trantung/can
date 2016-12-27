@extends('admin.layout.default')
@section('title')
{{ $title=' Thêm hồ sơ nhân viên' }}
@stop

@section('content')

<div class="row margin-bottom">
  <div class="col-xs-12">
    {{-- <a href="{{ action('HumanResourcesController@index') }}" class="btn btn-success"> Hồ sơ nhân viên</a> --}}
  </div>
</div>
<div class="row">
    {{ Form::open(array('action' => 'HumanResourcesController@store')) }}
        <div class="col-md-6 col-sm-12 col-xs-12">
            @include('admin.hr.template.employment_left_infomation')
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
            @include('admin.hr.template.employment_right_infomation')
        </div>
    {{ Form::close() }}
</div>

@if(isset($personal->employmentEducational))
<hr>
@include('admin.hr.template.employment_educational')
<hr>
@include('admin.hr.template.employment_history')
@endif
<style type="text/css">
    hr {
    margin-top: 20px;
    margin-bottom: 20px;
    border: 0;
    border-top: 1px solid #aaa;
}
</style>
@stop
