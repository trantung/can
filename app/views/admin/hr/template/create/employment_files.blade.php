<div class="row">
    <div class="col-xs-12">
    <h3>File đính kèm <span><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addNewEmployerFiles">Thêm mới</button></span></h3>
    @if($personal->employmentFiles->count()>0)
        <div>
         <div class="box-body table-responsive no-padding">
              <table class="table table-striped">
                <tr>
                  <th>Tên file</th>
                  <th style="width:200px;">Action</th>
                </tr>
                @foreach($personal->employmentFiles as $key => $value)
                <tr>
                  <td>{{$value->name}}</td>
                  <td>
                    <a href="{{ url($value->link) }}"  class="btn btn-info btn-xs">Xem</a>
                    <a href="{{ url($value->link) }}"  class="btn btn-primary btn-xs">Tải về</a>

                    {{-- <div class="admin-action"> --}}
                        {{ Form::open(array('method' => 'DELETE', 'route' => ['employment.destroyFile', $personal->id, $value->id], 'style'=>" display: inline-block;")) }}
                        <input href="#" type ="submit" class="btn btn-danger  btn-xs" aria-hidden="true" onclick="return confirm('Bạn có chắc chắn muốn xóa?');" value="Xóa"/>
                        {{ Form::close() }}
                    {{-- </div> --}}
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
<div class="modal fade" id="addNewEmployerFiles" tabindex="-1" role="dialog" aria-labelledby="addNewEmployerFilesLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    {{
        Form::open([
            'class' => 'form-horizontal',
            'method' => 'POST',
            'route' => ['employment.newFiles', $personal->id],
            'files' => true
        ])
    }}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="addNewEmployerFilesLabel">Thêm mới files </h4>
      </div>
        <div class="modal-body">
                <div class="well well-lg">
                @if (count($errors->all()) > 0 && Session::get('add_new_employer_file'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ HTML::ul($errors->all()) }}
                </div>
                @endif
                    <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Tên<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            {{ Form::text('file_name', Input::old('file_name'), array('class'=>'form-control input-sm')) }}
                        </div>
                    </div>
                    {{-- file_name --}}

                   <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">File<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input class="form-control input-sm" type="file" name="file" value="{{Input::old('file');}}">
                        </div>
                    </div>
                    {{-- File --}}

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

@if ($model1 = Session::get('add_new_employer_file'))
    <script type="text/javascript" charset="utf-8" async defer>
        $(document).ready(function(){
            $('#addNewEmployerFiles').modal('show');
        });
    </script>
@endif