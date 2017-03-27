@extends('admin.layout.default')
@section('title')
{{ $title=' Thêm hồ sơ nhân viên' }}
@stop
@section('content')
<link rel="stylesheet" type="text/css" href="/assets/js/combotree/themes/metro/easyui.css">

<link rel="stylesheet" type="text/css" href="/assets/js/combotree/themes/icon.css">
<link rel="stylesheet" type="text/css" href="/assets/js/combotree/demo/demo.css">
<div class="row margin-bottom">
  <div class="col-xs-12">
    {{-- <a href="{{ action('HumanResourcesController@index') }}" class="btn btn-success"> Hồ sơ nhân viên</a> --}}
  </div>
</div>
<div class="row">
    {{ Form::open(array('action' => 'HumanResourcesController@store', 'files' => true)) }}
        <fieldset>
            <legend>Thông tin cá nhân</legend>
        <div class="col-md-7 col-sm-7 col-xs-12">
            @include('admin.hr.template.create.employment_left_infomation')
        </div>
        <div class="col-md-5 col-sm-5 col-xs-12">
            @include('admin.hr.template.create.employment_right_infomation')
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group form-group-sm">
                        <label class="control-label">Ngân hàng</label>
                        {{-- <input value="{{$personal->ngan_hang}}"  class="form-control input-sm" type="text" name="ngan_hang" placeholder="Ngân hàng"> --}}
                        {{ Form::select('bank_category', $danh_sach_ngan_hang,  Input::old('bank_category'), array('class'=>'form-control input-sm')) }}
                    </div>
                    {{-- ngan_hang --}}
                    <div class="form-group form-group-sm ">
                        <label class="control-label">Ngày kết thúc thử việc</label>
                        <input class="form-control input-sm" type="text" name="ngay_ket_thuc_thu_viec" id="datepicker6" placeholder="Ngày kết thúc thử việc" value="{{Input::old('ngay_ket_thuc_thu_viec')}}">
                    </div>
                    {{-- ngay_ket_thuc_thu_viec --}}
                </div>
                {{-- 1 --}}
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group form-group-sm">
                        <label class="control-label">Số tài khoản</label>
                        <input value="{{Input::old('so_tai_khoan')}}"  class="form-control input-sm" type="text" name="so_tai_khoan" placeholder="Số tài khoản">
                    </div>
                    {{-- so_tai_khoan --}}
                    <div class="form-group form-group-sm ">
                        <label class="control-label">Ngày vào làm</label>
                        <input class="form-control input-sm" type="text" name="ngay_vao_cong_ty" id="datepicker5" placeholder="Ngày vào làm" value="{{Input::old('ngay_vao_cong_ty')}}">
                    </div>
                    {{-- ngay_vao_cong_ty --}}
                </div>
                {{-- 2 --}}
                <div class="col-md-3 col-sm-6 col-xs-12">
                     <div class="form-group form-group-sm">
                        <label class="control-label">Lương cơ bản</label>
                        <input value="{{Input::old('luong_co_ban')}}"  class="form-control input-sm" type="text" name="luong_co_ban" placeholder="lương cơ bản">
                    </div>
                    {{-- luong_co_ban --}}
                    <div class="form-group form-group-sm">
                        <label class="control-label">Nguyên quán</label>
                        <input value="{{Input::old('nguyen_quan')}}"  class="form-control input-sm" type="text" name="nguyen_quan" placeholder="Nguyên quán">
                    </div>
                    {{-- nguyen_quan --}}
                </div>
                {{-- 3 --}}
                 <div class="col-md-3 col-sm-6 col-xs-12">
                     <div class="form-group form-group-sm">
                        <label class="control-label">Tiền tệ</label>
                         {{ Form::select('currency_category', $danh_sach_tien_te, Input::old('currency_category'), array('class'=>'form-control input-sm')) }}
                    </div>
                    {{-- luong_co_ban --}}
                    <div class="form-group form-group-sm">
                        <label class="control-label">Phòng ban</label>
                        <input name="company_id" class="easyui-combotree" data-options="url:'/admin/test',method:'get'" style="width:100%">
                    </div>
                    {{-- luong_co_ban --}}
                </div>
                {{-- 4 --}}
            </div>
            <div class="pull-right" style="margin-top:40px">
                <div class="form-group form-group-sm ">
                    <input type="submit" class="btn btn-primary" value="Tạo mới">
                </div>
            </div>
        </div>
         </fieldset>

        {{-- <fieldset>
            <legend>Nơi làm việc</legend>
            @include('admin.hr.template.create.office')
        </fieldset> --}}
        <div class="pull-right" style="margin-top:40px">
            <div class="form-group form-group-sm ">
                <input type="submit" class="btn btn-primary" value="Thêm mới">
            </div>
        </div>
    {{ Form::close() }}
</div>
<script type="text/javascript" src="/assets/js/combotree/jquery.easyui.min.js"></script>

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