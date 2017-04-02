@extends('admin.layout.default')
@section('title')
{{ $title=' Hồ sơ nhân viên' }}
@stop

@section('content')
<ul class="nav nav-tabs">
    <li class="active">
        <a href="#tab_1_1" data-toggle="tab"> Thông tin cá nhân </a>
    </li>
    <li>
        <a href="#tab_1_2" data-toggle="tab"> Nơi làm việc </a>
    </li>
    <li>
        <a href="#tab_1_3" data-toggle="tab"> Trình độ học vấn </a>
    </li>
    <li>
        <a href="#tab_1_4" data-toggle="tab"> Lịch sử công tác </a>
    </li>
    <li>
        <a href="#tab_1_5" data-toggle="tab"> File đính kèm </a>
    </li>
    <li>
        <a href="#tab_1_6" data-toggle="tab"> Lịch sử khen thưởng kỉ luật </a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane fade active in" id="tab_1_1">
        <div class="row">
            {{ Form::open(array('action' => array('HumanResourcesController@update', $personal->id), 'method' => 'PUT', 'files' => true)) }}
             <fieldset>
                    <legend>Thông tin cá nhân</legend>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    @include('admin.hr.template.edit_employment_left_infomation')
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    @include('admin.hr.template.edit_employment_right_infomation')
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="form-group form-group-sm">
                                <label class="control-label">Ngân hàng</label>
                                {{-- <input value="{{$personal->ngan_hang}}"  class="form-control input-sm" type="text" name="ngan_hang" placeholder="Ngân hàng"> --}}
                                {{ Form::select('bank_category', $danh_sach_ngan_hang, $personal->bank_category, array('class'=>'form-control input-sm')) }}
                            </div>
                            {{-- ngan_hang --}}
                            <div class="form-group form-group-sm ">
                                <label class="control-label">Ngày kết thúc thử việc</label>
                                <input class="form-control input-sm" type="text" name="ngay_ket_thuc_thu_viec" id="datepicker6" placeholder="Ngày kết thúc thử việc" value="{{$personal->ngay_ket_thuc_thu_viec}}">
                            </div>
                            {{-- ngay_ket_thuc_thu_viec --}}
                        </div>
                        {{-- 1 --}}
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="form-group form-group-sm">
                                <label class="control-label">Số tài khoản</label>
                                <input value="{{$personal->so_tai_khoan}}"  class="form-control input-sm" type="text" name="so_tai_khoan" placeholder="Số tài khoản">
                            </div>
                            {{-- so_tai_khoan --}}
                            <div class="form-group form-group-sm ">
                                <label class="control-label">Ngày vào làm</label>
                                <input class="form-control input-sm" type="text" name="ngay_vao_cong_ty" id="datepicker5" placeholder="Ngày vào làm" value="{{$personal->ngay_vao_cong_ty}}">
                            </div>
                            {{-- ngay_vao_cong_ty --}}
                        </div>
                        {{-- 2 --}}
                        <div class="col-md-3 col-sm-6 col-xs-12">
                             <div class="form-group form-group-sm">
                                <label class="control-label">Lương cơ bản</label>
                                <input value="{{$personal->luong_co_ban}}"  class="form-control input-sm" type="text" name="luong_co_ban" placeholder="lương cơ bản">
                            </div>
                            {{-- luong_co_ban --}}
                            <div class="form-group form-group-sm">
                                <label class="control-label">Nguyên quán</label>
                                <input value="{{$personal->nguyen_quan}}"  class="form-control input-sm" type="text" name="nguyen_quan" placeholder="Nguyên quán">
                            </div>
                            {{-- nguyen_quan --}}
                        </div>
                        {{-- 3 --}}
                         <div class="col-md-3 col-sm-6 col-xs-12">
                             <div class="form-group form-group-sm">
                                <label class="control-label">Tiền tệ</label>
                                 {{ Form::select('currency_category', $danh_sach_tien_te, $personal->currency_category, array('class'=>'form-control input-sm')) }}
                            </div>
                            {{-- luong_co_ban --}}
                        </div>
                        {{-- 4 --}}
                    </div>
                    <div class="pull-right" style="margin-top:40px">
                        <div class="form-group form-group-sm ">
                            <input type="submit" class="btn btn-primary" value="Cập nhật">
                        </div>
                    </div>
                </div>
            </fieldset>
            {{ Form::close() }}
        </div>
    </div>
    <div class="tab-pane fade" id="tab_1_2">
        @include('admin.hr.template.create.employment_positions')
    </div>
    <div class="tab-pane fade" id="tab_1_3">
        @include('admin.hr.template.create.employment_educational')
    </div>
    <div class="tab-pane fade" id="tab_1_4">
        @include('admin.hr.template.create.employment_history')
    </div>
    <div class="tab-pane fade" id="tab_1_5">
        @include('admin.hr.template.create.employment_files')
    </div>
    <div class="tab-pane fade" id="tab_1_6">
        @include('admin.hr.template.create.employment_bonus_history')
    </div>
</div>


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
