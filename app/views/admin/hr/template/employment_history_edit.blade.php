@extends('admin.layout.default')
@section('title')
{{ $title='Chỉnh sửa' }}
@stop

@section('content')

<div class="row margin-bottom">
</div>
<div class="row">
    {{ Form::open(array('action' => array('EmploymentHistoryController@updateHistory', $company->personal_id, $company->id), 'method' => 'PUT', 'files' => true)) }}
            <div class="well well-lg">
                @if (count($errors->all()) > 0 && Session::get('add_new_employer_history'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ HTML::ul($errors->all()) }}
                </div>
                @endif
                    <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Công ty<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            {{ Form::select('company_name', $company_category_id, $company->company_name, array('class'=>'form-control input-sm', 'id'=>'company_name_select1')) }}

                            <input class="form-control input-sm" type="text" name="company_name_text" placeholder="Lý do chuyển công tác" value="{{$company->company_name_text}}" style="display: none;" , id='company_name_text1'>

                            <input type="checkbox" id="hideHistory1" name="is_text" > Công ty không có trong hệ thống
                        </div>
                    </div>
                    {{-- company name --}}
                    <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Vị trí<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                        {{ Form::select('position', $position_category_id, $company->position, array('class'=>'form-control input-sm', 'id'=>'section_position_model')) }}
                        </div>
                    </div>
                    {{-- position--}}

                    {{-- <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Chức danh<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                        {{ Form::select('position', $position_category_id, $company->position, array('class'=>'form-control input-sm',  'id'=>'section_position_model')) }}
                        </div>
                    </div> --}}
                    {{-- position--}}
                   {{--  <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Chức vụ<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                        {{ Form::select('officer', $officer_category_id, Input::old('officer'), array('class'=>'form-control input-sm',  'id'=>'section_officer_model')) }}
                        </div>
                    </div> --}}
                    {{-- officer--}}

                    <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Ngày bắt đầu<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                        <input type="text" name="start_date" class="form-control" id="datepicker1" placeholder="Từ ngày yyyy-mm-dd" value="{{$company->start_date}}"/>
                        </div>
                    </div>
                    {{-- start_date --}}
                    <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Ngày kết thúc</label>
                        <div class="col-lg-8">
                        <input type="text" name="end_date" class="form-control" id="datepicker2" placeholder="Đến ngày yyyy-mm-dd" value="{{$company->end_date != '0000-00-00'? $company->end_date: ''}}"/>
                        </div>
                    </div>
                    {{-- end_date --}}
                   <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Lý do chuyển công tác<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input class="form-control input-sm" type="text" name="why_out" placeholder="Lý do chuyển công tác" value="{{$company->why_out}}">
                        </div>
                    </div>
                    {{-- why out --}}
                    <div class="form-group form-group-sm row">
                        <label class=" col-lg-3 control-label">Ghi chú</label>
                        <div class="col-lg-8">
                            <textarea  class="form-control input-sm" type="text" name="description" placeholder="Ghi chú">{{$company->description}}</textarea>
                        </div>
                    </div>
                    {{-- description --}}

                    <a class="btn btn-default" href="{{ route('hr.edit', $company->personal_id) }}">Hủy</a>
                    <button class="btn btn-primary" value="submit">Sửa</button>
                </div>
    {{ Form::close() }}
</div>
<script type="text/javascript" charset="utf-8" async defer>
    // $('#startdate').datepicker({
    //     dateFormat: 'yy-mm-dd',
    // });
    // $('#enddate').datepicker({
    //     dateFormat: 'yy-mm-dd',
    // });
    $('#hideHistory1').click(function(){
        var e = $('#hideHistory1').is(":checked");
        if (e) {

            $('#company_name_select1').hide();
            $('#company_name_text1').show();
        }else{

            $('#company_name_select1').show();
            $('#company_name_text1').hide();
        }
    });
    $(document).ready(function(){
        @if ($company->company_name == 0)
            $('#hideHistory1').click();
        @endif
    })
</script>
@stop
