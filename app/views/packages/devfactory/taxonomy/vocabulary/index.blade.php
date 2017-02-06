@extends($layout->extends)

@section($layout->header)
  <h1>@lang('taxonomy::vocabulary.index.header')</h1>
@stop

@section($layout->content)

  <div class="row">

    <div class="col-sm-6 col-md-6">

      <div class="box">

        <div class="box-header">

          <h3 class="box-title">
            @lang('taxonomy::vocabulary.vocabularies')
          </h3>

        </div>

        <div class="box-body table-responsive no-padding">

          <table class="table table-hover">

            <tbody>
              <tr>
                <th class="span2">
                  @lang('taxonomy::vocabulary.table.name')
                </th>
                <th class="span2">
                  @lang('taxonomy::vocabulary.table.actions')
                </th>
              </tr>
            </tbody>

            <tbody>
              @foreach ($vocabularies as $vocabulary)
                <tr>
                  <td>{{ $vocabulary->name }}</td>
                  <td class="text-right">

                    <div class="btn-group">
                      {{ Form::open(array('method' => 'GET', 'route' => array($prefix . 'taxonomy.edit', $vocabulary->id))) }}
		      {{ Form::button(Lang::get('taxonomy::vocabulary.index.button.view_terms'), array('class'=>'btn btn-xs btn-primary btn-flat', 'type' => 'submit')) }}
		      {{ Form::close() }}
                    </div>

                  </td>
                </tr>
              @endforeach
            </tbody>

          </table>

        </div>

        <div class="box-footer clearfix">
          {{ $vocabularies->links() }}
        </div>

      </div>

    </div>

    <div class="col-sm-6 col-md-6">
        <div class="box box-primary">
        <!-- form start -->
        {{ Form::open(array('action' => 'Admin2Controller@store')) }}
          <div class="box-body">
            <div class="form-group">
              <label for="username">Tên Level</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="name" placeholder="Tên Bằng cấp & chứng chỉ" name="name" value="{{Input::old('name')}}">
                </div>
              </div>
            </div>

          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <input type="submit" class="btn btn-primary" value="Lưu lại" />
          </div>
        {{ Form::close() }}
      </div>
      <!-- /.box -->
    </div>
  </div>

@stop
