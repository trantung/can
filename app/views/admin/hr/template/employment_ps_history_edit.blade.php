@extends('admin.layout.default')
@section('title')
{{ $title='Chỉnh sửa' }}
@stop

@section('content')

<div class="row margin-bottom">
</div>
<div class="row">
    {{ Form::open(array('action' => array('EmploymentHistoryController@updatePsHistory', $company->personal_id, $company->id), 'method' => 'PUT', 'files' => true)) }}
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
                        </div>
                    </div>
                    {{-- company name --}}

                    <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Chức vụ<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                        {{ Form::select('position', $position_category_id, Input::old('position'), array('class'=>'form-control input-sm',  'id'=>'section_position_model')) }}
                        </div>
                    </div>
                    {{-- position--}}
                    <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Ngày bắt đầu<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                        <input type="text" name="start_date" class="form-control" id="startdate" placeholder="Từ ngày yyyy-mm-dd" value="{{$company->start_date}}"/>
                        </div>
                    </div>
                    {{-- start_date --}}
                    <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Công văn bổ nhiệm</label>
                        <div class="col-lg-8">
                            <input class="form-control input-sm" type="file" name="attach_file" value="{{$company->attach_file}}">
                        </div>
                    </div>
                    {{-- file_name --}}
                    <a class="btn btn-info" href="{{ route('hr.is_main_position',[$company->personal_id, $company->id]  ) }}">Đặt làm vị trí chính</a>

                    <a class="btn btn-default" href="{{ route('hr.edit', $company->personal_id) }}">Hủy</a>
                    <button class="btn btn-primary" value="submit">Sửa</button>
                </div>
    {{ Form::close() }}
</div>
<script type="text/javascript" charset="utf-8" async defer>
    $('#startdate').datepicker({
        dateFormat: 'yy-mm-dd',
    });
    $('#enddate').datepicker({
        dateFormat: 'yy-mm-dd',
    });
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
