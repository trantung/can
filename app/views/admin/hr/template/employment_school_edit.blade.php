@extends('admin.layout.default')
@section('title')
{{ $title='Chỉnh sửa' }}
@stop

@section('content')

<div class="row margin-bottom">
</div>
<div class="row">
    {{ Form::open(array('action' => array('EmploymentEducationalController@updateSchool', $school->personal_id, $school->id), 'method' => 'PUT', 'files' => true)) }}
       <div class="well well-lg">
            @if (count($errors->all()) > 0 && Session::get('model1'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ HTML::ul($errors->all()) }}
            </div>
            @endif
            <div class="form-group form-group-sm row">
                <label class="col-lg-3 control-label">Trường<span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <input class="form-control input-sm" type="text" name="school_name" placeholder="Tên trường" value="{{$school->school_name}}">
                </div>
            </div>
            {{-- school name --}}
            <div class="form-group form-group-sm row">
                <label class="col-lg-3 control-label">Ngành học<span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    {{ Form::select('industry_id', $industry_category_id, $school->industry_id, array('class'=>'form-control input-sm')) }}
                </div>
            </div>
            {{-- industry id--}}
            <div class="form-group form-group-sm row">
                <label class="col-lg-3 control-label">Bằng cấp & chứng chỉ<span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    {{ Form::select('certificate_id', $certificate_category_id, $school->certificate_id, array('class'=>'form-control input-sm')) }}
                </div>
            </div>
            {{-- certificate id--}}
            <div class="form-group form-group-sm row">
                <label class="col-lg-3 control-label">Năm tốt nghiệp<span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <input type="text" name="graduation_year" class="form-control" id="datepicker1" placeholder="yyyy-mm-dd" value="{{$school->graduation_year}}" />
                </div>
            </div>
            {{-- graduation year--}}
            <a class="btn btn-default" href="{{ route('hr.edit', $school->personal_id) }}">Hủy</a>
            <button class="btn btn-primary" value="submit">Sửa</button>
        </div>

    {{ Form::close() }}
</div>
@stop
