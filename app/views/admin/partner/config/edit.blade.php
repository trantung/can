@extends('admin.layout.default')

@section('title')
{{ $title='Chỉnh sửa đối tác "'. $data->doi_tac_ten .'"' }}
@stop

@section('content')
<div class="row margin-bottom">
  <div class="col-xs-12">
    <a href="{{ action('ManagePartnerController@index') }}" class="btn btn-success">Danh sách</a>
  </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            {{ Form::open(array('action' => array('ManagePartnerController@update', $data->id), 'method' => 'PUT')) }}
               <div class="box-body">
                <div class="form-group">
                  <label for="module_id">đối tác</label>
                  <div class="row">
                    <div class="col-sm-6">
                      {{ $data->doi_tac_ten }}
                  </div>
                </div>
                <div class="form-group">
                  <label for="username">Lựa chọn nhóm đối tác</label>
                  <div class="row">
                    <div class="col-sm-6">
                      {{ Form::select('partner_group_id',['' => 'Chọn']+ $listPersonal, $customerGroup, array('class' => 'form-control', 'id' => 'partner_group_id'))}}
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="module_id">Các đối tác trong nhóm (<span class="total-customer"> 0 </span>)</label>
                  <div class="row">
                    <div class="col-sm-6 list-customer">
                    </div>
                  </div>
                </div>

               </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="submit" class="btn btn-primary" value="Lưu lại" />
                <input type="reset" class="btn btn-default" value="Nhập lại" />
              </div>
            {{ Form::close() }}
        </div>
        <!-- /.box -->
    </div>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    $('#partner_group_id').on('change', function (e) {
          var id = $('#partner_group_id').val();
          if (id != 0) {
            getCustomerByGroup(id);
          }
      });
  });
  function getCustomerByGroup(id) {
    $.ajax({
      type: "GET",
      url: '/api/request/partner-by-group/' + id,
      success: function(response){
        if (response.code == 200) {
          $('.list-customer').html('');
          $('.total-customer').html('');
          var html = '';
          $.each(response.data, function (i, item) {
            html += item.doi_tac_ten + ' - ' + item.doi_tac_dia_chi + '<br>';
          });
          $('.list-customer').append(html);
          $('.total-customer').append(response.data.length);
        }
      }
    });
  }
</script>
@stop
