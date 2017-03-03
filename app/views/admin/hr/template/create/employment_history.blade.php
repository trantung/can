<div class="row">
    <div class="col-xs-12">
    <h3>Lịch sử công tác <span><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewEmployerHistory">Thêm mới</button></span></h3>
@if($employmentHistory->count() > 0)
        <div class="">
         <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Công ty</th>
                  <th>Thời gian bắt đầu</th>
                  <th>Thời gian kết thúc</th>
                  <th>Vị trí</th>
                  <th>Lý do chuyển công tác</th>
                  <th>Ghi chú</th>
                  <th style="width:200px;">Action</th>
                </tr>
                @foreach($employmentHistory as $key => $value)
                {{-- {{dd($employmentHistory->toJson())}} --}}
                <tr>
                  <td>{{$value->company_name_text }}</td>
                  <td>
                    {{date('d-m-Y',strtotime($value->start_date ) )}}
                  </td>
                  <td>
                    @if($value->end_date == NULL || $value->end_date == '0000-00-00')
                        Đến nay
                    @else
                        {{date('d-m-Y',strtotime($value->end_date ) )}}
                    @endif
                  </td>
                  <td>{{isset($value->positionHistory->name) ? $value->positionHistory->name: '' }}</td>
                  <td>{{$value->why_out}}</td>
                  <td>{{$value->description}}</td>
                  <td>
                        <a href="{{ route('employment.editHistory', $value->id) }}" class="btn btn-info btn-xs">Sửa</a>
                        {{ Form::open(array('method' => 'DELETE', 'route' => ['employment.destroyHistory', $personal->id, $value->id], 'style'=>" display: inline-block;")) }}
                        <input href="#" type ="submit" class="btn btn-danger btn-xs" aria-hidden="true" onclick="return confirm('Bạn có chắc chắn muốn xóa?');" value="Xóa" />
                        {{ Form::close() }}
                  </td>
                </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->


        </div>
@endif
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
                            {{ Form::select('company_name', $company_category_id, Input::old('company_name'), array('class'=>'form-control input-sm', 'id'=>'company_name_select1')) }}

                            <input class="form-control input-sm" type="text" name="company_name_text" placeholder="Lý do chuyển công tác" value="{{Input::old('company_name_text');}}" style="display: none;" , id='company_name_text1'>

                            <input type="checkbox" id="hideHistory1" name="is_text"> Công ty không có trong hệ thống
                        </div>
                    </div>
                    {{-- company name --}}
                    {{-- company name --}}
                    {{-- <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label"><span class="text-danger">*</span>Chi nhánh</label>
                        <div class="col-lg-8">
                        {{ Form::select('branch', $branch_category_id, Input::old('branch'), array('class'=>'form-control input-sm', 'id'=>'section_branch_model')) }}
                        </div>
                    </div> --}}
                    <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Chức danh<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                        {{ Form::select('position', $position_category_id, Input::old('position'), array('class'=>'form-control input-sm',  'id'=>'section_position_model')) }}
                        </div>
                    </div>
                    {{-- position--}}
                    <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Chức vụ<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                        {{ Form::select('officer', $officer_category_id, Input::old('officer'), array('class'=>'form-control input-sm',  'id'=>'section_officer_model')) }}
                        </div>
                    </div>
                    {{-- officer--}}
                    <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Ngày bắt đầu<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                        <input type="text" name="start_date" class="form-control" id="startdate" placeholder="Từ ngày yyyy-mm-dd" value="{{Input::old('start_date');}}"/>
                        </div>
                    </div>
                    {{-- start_date --}}
                    <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Ngày kết thúc</label>
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
</script>
@if ($model1 = Session::get('add_new_employer_history'))
    <script type="text/javascript" charset="utf-8" async defer>
        $(document).ready(function(){
            $('#addNewEmployerHistory').modal('show');
        });
    </script>
@endif