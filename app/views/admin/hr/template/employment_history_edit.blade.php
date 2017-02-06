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
                            {{ Form::select('company_name', $company_category_id, $company->company_name, array('class'=>'form-control input-sm')) }}
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
@stop
