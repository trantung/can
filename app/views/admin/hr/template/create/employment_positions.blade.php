<div class="row">
    <div class="col-xs-12">
    <h3>Nơi làm việc <span><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewEmployerPosition">Thêm mới</button></span></h3>
@if($personal->EmploymentPositions->count() > 0)
        <div class="">
            <div class="box-body table-responsive no-padding">
              <table class="table table-striped">
                <tr>
                  <th>Công ty</th>
                  <th> Vị trí</th>
                  <th> Trạng thái</th>
                  <th> Ngày bắt đầu </th>
                  <th> Công văn bổ nhiệm </th>
                  <th style="width:200px;">Action</th>
                </tr>
                {{-- @foreach($personal->EmploymentPositions as $key => $value) --}}
                @foreach($employmentPositions as $key => $value)
                <tr>
                  <td>{{ $value->company_name_text }}</td>
                  <td>{{isset($position_category_id[$value->position])? $position_category_id[$value->position] : '' }}</td>
                  <td> {{$value->is_main_position =='N'? 'Kiêm nhiệm' : 'Vị trí chính'}}</td>
                  <td>{{date('d-m-Y',strtotime($value->start_date) )}}</td>
                  <td>@if(!empty($value->attachFile2))
                  <a href="{{ url($value->attachFile2->link) }}" download="{{$position_category_id[$value->position]}}-{{ $value->attachFile2->link }}">Tải về</a>@endif</td>
                  <td>
                        <a class="btn btn-info btn-xs" href="{{ route('hr.is_main_position',[$personal->id, $value->id]  ) }}">Vị trí chính</a>
                         {{ Form::open(array('method' => 'DELETE', 'route' => ['employment.moveHistory', $personal->id, $value->id], 'style'=>" display: inline-block;")) }}
                        <input href="#" type ="submit" class="btn btn-danger btn-xs" aria-hidden="true" onclick="return confirm('Bạn có chắc chắn muốn bỏ kiêm nhiệm?');" value="Bỏ kiêm nhiệm" />
                        {{ Form::close() }}
                    {{-- </div> --}}
                  </td>
                </tr>
                @endforeach
              </table>
            </div>

        </div>
@endif
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
            'route' => ['employment.newPosition', $personal->id],
            'files' => true
        ])
    }}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="addNewEmployerPosition">Thêm mới Nơi làm việc</h4>
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
                            {{ Form::select('company_name', $company_category_id, Input::old('company_name'), array('class'=>'form-control input-sm', 'id'=>'company_name_select')) }}

                            <input class="form-control input-sm" type="text" name="company_name_text" placeholder="Lý do chuyển công tác" value="{{Input::old('company_name_text');}}" style="display: none;" , id='company_name_text'>

                            <input type="checkbox" id="hideHistory1" name="is_text"> Công ty không có trong hệ thống
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
                    <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Công văn bổ nhiệm</label>
                        <div class="col-lg-8">
                            <input class="form-control input-sm" type="file" name="attach_file" value="{{Input::old('attach_file');}}">
                        </div>
                    </div>
                    {{-- file_name --}}
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
    $('#hideHistory1').click(function(){
        var e = $('#hideHistory1').is(":checked");
        if (e) {

            $('#company_name_text').show();
            $('#company_name_select').hide();
        }else{

            $('#company_name_select').show();
            $('#company_name_text').hide();
        }
    });
@if ($model1 = Session::get('add_new_employer_position'))
    {{-- <script type="text/javascript" charset="utf-8" async defer> --}}
    $(document).ready(function(){
        $('#addNewEmployerPosition').modal('show');
    });
    {{-- </script> --}}
@endif

</script>