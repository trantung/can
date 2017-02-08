<div class="row">
    <div class="col-xs-12">
    <h3>Chức vụ kiêm nhiệm <span><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewEmployerPosition">Thêm mới</button></span></h3>

        <div class="row">
            @foreach($personal->EmploymentPositions as $value)
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="well well-lg">

                <h4><b>{{isset($company_category_id[$value->company_name])? $company_category_id[$value->company_name]: '' }} </b></h4>
                Vị trí: {{isset($position_category_id[$value->position])? $position_category_id[$value->position] : '' }}</br>
                Ngày bắt đầu:<b> {{$value->start_date}}  </b></br>

                    <div class="admin-action">
                        {{ Form::open(array('method' => 'DELETE', 'route' => ['employment.moveHistory', $personal->id, $value->id], 'style'=>" display: inline-block;")) }}
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
<div class="modal fade" id="addNewEmployerPosition" tabindex="-1" role="dialog" aria-labelledby="addNewEmployerPosition">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    {{
        Form::open([
            'class' => 'form-horizontal',
            'method' => 'POST',
            'route' => ['employment.newPosition', $personal->id]
        ])
    }}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="addNewEmployerPosition">Thêm mới Chức vụ kiêm nhiệm </h4>
      </div>
        <div class="modal-body">
                <div class="well well-lg">
                @if (count($errors->all()) > 0 && Session::get('add_new_employer_position'))
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
                        <label class="col-lg-3 control-label">Chức vụ<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                        {{ Form::select('position', $position_category_id, Input::old('position'), array('class'=>'form-control input-sm',  'id'=>'section_position_model')) }}
                        </div>
                    </div>
                    {{-- position--}}
                    <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Ngày bắt đầu<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                        <input type="text" name="start_date" class="form-control" id="p_startdate" placeholder="Từ ngày yyyy-mm-dd" value="{{Input::old('start_date');}}"/>
                        </div>
                    </div>
                    {{-- start_date --}}
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
    $('#p_startdate').datepicker({
        dateFormat: 'yy-mm-dd',
    });
</script>
@if ($model1 = Session::get('add_new_employer_position'))
    <script type="text/javascript" charset="utf-8" async defer>
        $(document).ready(function(){
            $('#addNewEmployerPosition').modal('show');
        });
    </script>
@endif