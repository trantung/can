@extends('admin.layout.default')

@section('title')
{{ $title='Chỉnh sửa Khách hàng "'. $data->customer_name .'"' }}
@stop

@section('content')
<div class="row margin-bottom">
  <div class="col-xs-12">
    <a href="{{ action('ConfigCustomerController@index') }}" class="btn btn-success">Danh sách</a>
  </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            {{ Form::open(array('action' => array('ConfigCustomerController@update', $data->id), 'method' => 'PUT')) }}
               <div class="box-body">
                <div class="form-group">
                  <label for="module_id">Khách hàng</label>
                  <div class="row">
                    <div class="col-sm-6">
                      {{ $data->customer_name }}
                  </div>
                </div>
                <div class="form-group">
                  <label for="username">Lựa chọn nhóm khách hàng</label>
                  <div class="row">
                    <div class="col-sm-6">
                      {{ Form::select('customer_group_id',['' => 'Chọn']+ $listPersonal, $customerGroup, array('class' => 'form-control', 'id' => 'customer_group_id'))}}
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="module_id">Các khách hàng trong nhóm (<span class="total-customer"> 0 </span>)</label>
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
    $('#customer_group_id').on('change', function (e) {
          var id = $('#customer_group_id').val();
          if (id != 0) {
            getCustomerByGroup(id);
          }
      });
  });
  function getCustomerByGroup(id) {
    $.ajax({
      type: "GET",
      url: '/api/request/customer-by-group/' + id,
      success: function(response){
        if (response.code == 200) {
          $('.list-customer').html('');
          $('.total-customer').html('');
          var html = '';
          $.each(response.data, function (i, item) {
            html += item.customer_name + ' - ' + item.customer_address + '<br>';
          });
          $('.list-customer').append(html);
          $('.total-customer').append(response.data.length);
        }
      }
    });
  }
</script>
@stop
