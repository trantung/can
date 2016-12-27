@extends('admin.layout.default')
@section('title')
{{ $title=' Hồ sơ nhân viên' }}
@stop

@section('content')

<div class="row margin-bottom">
  <div class="col-xs-12">
    {{-- <a href="{{ action('HumanResourcesController@index') }}" class="btn btn-success"> Hồ sơ nhân viên</a> --}}
  </div>
</div>
<div class="row">
    {{ Form::open(array('action' => array('HumanResourcesController@update', $personal->id), 'method' => 'PUT', 'files' => true)) }}
        <div class="col-md-6 col-sm-12 col-xs-12">
            @include('admin.hr.template.edit_employment_left_infomation')
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
            @include('admin.hr.template.edit_employment_right_infomation')
        </div>
    {{ Form::close() }}
</div>
<hr>
@include('admin.hr.template.employment_educational')
<hr>
@include('admin.hr.template.employment_history')

<style type="text/css">
    hr {
    margin-top: 20px;
    margin-bottom: 20px;
    border: 0;
    border-top: 1px solid #aaa;
}
</style>
@stop
