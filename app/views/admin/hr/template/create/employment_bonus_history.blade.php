<div class="row">
    <div class="col-xs-12">
    <h3>Lịch sử khen thưởng kỉ luật <span><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewEmployerBonusHistory">Thêm mới</button></span></h3>

        <div class="row">
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Ngày tháng</th>
                  <th>Lý do</th>
                  <th>Ghi chú</th>
                  <th>Chỉnh sửa lần cuối</th>
                  <th style="width:200px;">Action</th>
                </tr>
                @foreach($personal->employmentBonusHistory as $key => $value)
                <tr>
                  <td>{{ date('d-m-Y',strtotime($value->date) )  }}</td>
                  <td>{{ $value->why_bonus }}</td>
                  <td>{{ $value->description }}</td>
                  <td>{{  date('h:m d-m-Y',strtotime($value->updated_at) ) }}</td>
                  <td>
                   {{ Form::open(array('method' => 'DELETE', 'route' => ['employment.destroyBonusHistory', $personal->id, $value->id], 'style'=>" display: inline-block;")) }}
                        <input href="#" type ="submit" class="text-danger input-delete" aria-hidden="true" onclick="return confirm('Bạn có chắc chắn muốn xóa?');" value="Xóa" />
                        {{ Form::close() }}
                  </td>
                </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
        </div>

    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="addNewEmployerBonusHistory" tabindex="-1" role="dialog" aria-labelledby="addNewEmployerBonusHistoryLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    {{
        Form::open([
            'class' => 'form-horizontal',
            'method' => 'POST',
            'route' => ['employment.newBonusHistory', $personal->id]
        ])
    }}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="addNewEmployerBonusHistoryLabel">Thêm mới khen thưởng kỉ luật </h4>
      </div>
        <div class="modal-body">
                <div class="well well-lg">
                @if (count($errors->all()) > 0 && Session::get('add_new_employer_history_bonus'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ HTML::ul($errors->all()) }}
                </div>
                @endif
                    <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Ngày <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                        <input type="text" name="date" class="form-control" id="date_bonus" placeholder="Từ ngày yyyy-mm-dd" value="{{Input::old('data');}}"/>
                        </div>
                    </div>
                    {{-- data --}}
                    <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Lý do<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input class="form-control input-sm" type="text" name="why_bonus" placeholder="Lý do" value="{{Input::old('why_bonus');}}">
                        </div>
                    </div>
                    {{--why bonus --}}
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

@if ($model1 = Session::get('add_new_employer_bonus_history'))
    <script type="text/javascript" charset="utf-8" async defer>
        $(document).ready(function(){
            $('#addNewEmployerBonusHistory').modal('show');
        });
    </script>
@endif