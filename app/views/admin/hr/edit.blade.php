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
        <div class="pull-right" style="margin-top:40px">
            <div class="form-group form-group-sm ">
                <input type="submit" class="btn btn-primary" value="Thêm mới">
            </div>
        </div>
    {{ Form::close() }}
</div>
<hr>
@include('admin.hr.template.create.employment_positions')
<hr>
@include('admin.hr.template.create.employment_educational')
<hr>
@include('admin.hr.template.create.employment_history')
<hr>
@include('admin.hr.template.create.employment_files')
<hr>
@include('admin.hr.template.create.employment_bonus_history')


<style type="text/css">
    hr {
    margin-top: 20px;
    margin-bottom: 20px;
    border: 0;
    border-top: 1px solid #aaa;
}
</style>
<script>
     $(document).ready(function(){
        $('#section_branch').change( function($this){
            // console.log($('#section_branch').val());
                // var token =  $("input[name=_token]").val();
                // var data = {'branch_category_id':$('#section_branch').val()};
                // $.ajax({
                //     type: "GET",
                {{-- //     url : "{{action('PositionCategoryController@getPositionWithBranch')}}", --}}
                //     data : data,
                //     success : function(data){
                //         var select = '';
                //         // data.foreach(function(item){
                //         //     select = select . '<option value="1">CTO</option>'
                //         // });
                //         for (var key in data) {
                //             var value = data[key];
                //             select = select + '<option value="'+key+'">'+data[key]+'</option>';
                //         }
                //         $('#section_position').html(select);
                //         // console.log(select);
                //     }
                // },"json");

        })
     });
</script>
@stop
