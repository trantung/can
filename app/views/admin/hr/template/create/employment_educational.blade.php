<div class="row">
    <div class="col-xs-12">
    <h3>Trình độ học vấn <span><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewSchool">Thêm mới</button></span></h3>

@if($personal->employmentEducational->count() > 0)
        <div >
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Trường</th>
                  <th>Ngành học</th>
                  <th>Bằng cấp & chứng chỉ</th>
                  <th>Năm tốt nghiệp</th>
                  <th>Chỉnh sửa lần cuối</th>
                  <th style="width:200px;">Action</th>
                </tr>
                @foreach($personal->employmentEducational as $key => $value)
                <tr>
                  <td>{{$value->school_name}}</td>
                  <td>{{$industry_category_id[$value->industry_id]}}</td>
                  <td>{{$bang_cap[$value->certificate_id]}}</td>
                  <td>{{date('d-m-Y',strtotime($value->graduation_year) ) }}</td>
                  <td>{{  date('h:m d-m-Y',strtotime($value->updated_at) ) }}</td>
                  <td>
                    <a href="{{ route('employment.edit', $value->id) }}" class="btn btn-info  btn-xs">Sửa</a>
                        {{ Form::open(array('method'=>'DELETE', 'route' => ['employment.destroy', $personal->id, $value->id], 'style'=>" display: inline-block;")) }}
                        <input href="#" type ="submit" class="btn btn-danger  btn-xs" aria-hidden="true" onclick="return confirm('Bạn có chắc chắn muốn xóa?');" value="Xóa" />
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
@if ($model1 = Session::get('model1'))
    <script type="text/javascript" charset="utf-8" async defer>
        $(document).ready(function(){
            $('#addNewSchool').modal('show');
        });
    </script>
@endif
<!-- Modal -->
<div class="modal fade in" aria-hidden="true" id="addNewSchool" tabindex="-1" role="dialog" aria-labelledby="addNewSchoolLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    {{
        Form::open([
            'class' => 'form-horizontal',
            'method' => 'POST',
            'route' => ['employment.newEducation', $personal->id]
        ])
    }}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="addNewSchoolLabel">Thêm mới trường đã học</h4>
      </div>
      <div class="modal-body">
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
                            <input class="form-control input-sm" type="text" name="school_name" placeholder="Tên trường" value="{{Input::old('school_name');}}">
                        </div>
                    </div>
                    {{-- school name --}}
                    <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Ngành học<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            {{ Form::select('industry_id', $industry_category_id, Input::old('industry_id'), array('class'=>'form-control input-sm')) }}
                        </div>
                    </div>
                    {{-- industry id--}}
                    <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Bằng cấp & chứng chỉ<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            {{ Form::select('certificate_id', $certificate_category_id, Input::old('certificate_id'), array('class'=>'form-control input-sm')) }}
                        </div>
                    </div>
                    {{-- certificate id--}}
                    <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Năm tốt nghiệp<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="text" name="graduation_year" class="form-control" id="datepickerGraduation" placeholder="yyyy-mm-dd" value="{{Input::old('graduation_year');}}" />
                        </div>
                    </div>
                    {{-- graduation year--}}
                </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
        <button class="btn btn-primary" value="submit">Thêm mới</button>
      </div>

    {{ Form::close() }}

    </div>
  </div>
</div>
<script type="text/javascript" charset="utf-8" async defer>
    $('#datepickerGraduation').datepicker({
        dateFormat: 'yy-mm-dd',
    });
</script>
<style>
.admin-action{
    top: 5px;
    right: 20px;
    position: absolute;
}
</style>