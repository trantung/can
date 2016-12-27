<div class="row">
    <div class="col-xs-12">
    <h3>Lịch sử công tác <span><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewEmployerHistory">Thêm mới</button></span></h3>

        <div class="row">
            @foreach($personal->employmentHistory as $value)
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="well well-lg">
                <h4><b>{{isset($company_category_id[$value->company_name])? $company_category_id[$value->company_name]: '' }} - {{isset($branch_category_id[$value->branch])? $branch_category_id[$value->branch]: "" }}</b></h4>
                {{$value->start_date}}  <b>-</b> {{$value->end_date}} </br>
                Vị trí: {{isset($position_category_id[$value->position])? $position_category_id[$value->position] : '' }}</br>
                Lý do chuyển công tác: {{$value->why_out}} </br>
                Ghi chú: {{$value->description}}
                    <div class="admin-action">
                        {{-- <a href="/admin/{{$personal->id}}/employment-education/{{$value->id}}/edit" aria-hidden="true" style=" display: inline-block;">sửa</a> --}}
                        <a href="{{ route('employment.editHistory', $value->id) }}" style=" display: inline-block;">Sửa</a>
                        {{ Form::open(array('method' => 'DELETE', 'route' => ['employment.destroyHistory', $personal->id, $value->id], 'style'=>" display: inline-block;")) }}
                        <input href="#" type ="submit" class="text-danger input-delete" aria-hidden="true" onclick="return confirm('Bạn có chắc chắn muốn xóa?');" value="Xóa" />
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="addNewEmployerHistory" tabindex="-1" role="dialog" aria-labelledby="addNewEmployerHistoryLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    {{
        Form::open([
            'class' => 'form-horizontal',
            'method' => 'POST',
            'route' => ['employment.newHistory', $personal->id]
        ])
    }}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="addNewEmployerHistoryLabel">Thêm mới lịch sử công tác </h4>
      </div>
        <div class="modal-body">
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
                            {{ Form::select('company_name', $company_category_id, Input::old('company_name'), array('class'=>'form-control input-sm')) }}
                        </div>
                    </div>
                    {{-- company name --}}
                    <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Chi nhánh</label>
                        <div class="col-lg-8">
                        {{ Form::select('branch', $branch_category_id, Input::old('branch'), array('class'=>'form-control input-sm')) }}
                        </div>
                    </div>
                    <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Vị trí<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                        {{ Form::select('position', $position_category_id, Input::old('position'), array('class'=>'form-control input-sm')) }}
                        </div>
                    </div>
                    {{-- position--}}
                    <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Ngày kết thúc<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                        <input type="text" name="start_date" class="form-control" id="startdate" placeholder="Từ ngày yyyy-mm-dd" value="{{Input::old('start_date');}}"/>
                        </div>
                    </div>
                    {{-- start_date --}}
                    <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Ngày kết thúc<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                        <input type="text" name="end_date" class="form-control" id="enddate" placeholder="Đến ngày yyyy-mm-dd" value="{{Input::old('end_date');}}"/>
                        </div>
                    </div>
                    {{-- end_date --}}
                   <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Lý do chuyển công tác<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input class="form-control input-sm" type="text" name="why_out" placeholder="Lý do chuyển công tác" value="{{Input::old('why_out');}}">
                        </div>
                    </div>
                    {{-- why out --}}
                    <div class="form-group form-group-sm row">
                        <label class=" col-lg-3 control-label">Ghi chú</label>
                        <div class="col-lg-8">
                            <textarea  class="form-control input-sm" type="text" name="description" placeholder="Ghi chú">{{Input::old('description');}}</textarea>
                        </div>
                    </div>
                    {{-- description --}}
                </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
        <button type="submit" class="btn btn-primary">Thêm mới</button>
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
<script type="text/javascript" charset="utf-8" async defer>
    $('#startdate').datepicker({
        dateFormat: 'yy-mm-dd',
    });
    $('#enddate').datepicker({
        dateFormat: 'yy-mm-dd',
    });
</script>
@if ($model1 = Session::get('add_new_employer_history'))
    <script type="text/javascript" charset="utf-8" async defer>
        $(document).ready(function(){
            $('#addNewEmployerHistory').modal('show');
        });
    </script>
@endif