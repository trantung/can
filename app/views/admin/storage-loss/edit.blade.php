@extends('admin.layout.default')

@section('title')
{{ $title='Chỉnh sửa "'. $data->name .'"' }}
@stop

@section('content')

@if(Admin::isAdmin())
<div class="row margin-bottom">
    <div class="col-xs-12">
        <a href="{{ action('StorageLossController@index') }}" class="btn btn-success">Danh sách</a>
        <a href="{{ action('StorageLossController@create') }}" class="btn btn-primary">Thêm</a>
    </div>
</div>
@endif

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            {{ Form::open(array('action' => 'StorageLossController@store')) }}
            <div class="box-body">
              <div class="form-group">
                <label for="username">Loại hàng</label>
                <div class="row">
                  <div class="col-sm-6"> 
                    {{ Form::select('model_name', ['' => 'Chọn', 1 => 'Nguyên liệu thô', 2 => 'Thành phẩm'], $data->model_name,  array('class' => 'form-control', 'id' => 'model_name'))}}
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="username">Sản phẩm</label>
                <div class="row">
                  <div class="col-sm-6">
                    {{ Form::select('model_id', ['' => 'Chọn'], $data->model_id,  array('class' => 'form-control', 'id' => 'model_id'))}}
                  </div>
                </div>
              </div>
             
              <div class="form-group">
                <label for="username">Kho</label>
                <div class="row">
                  <div class="col-sm-6">
                    {{ Form::select('warehouse_id', ['' => 'Chọn'] + Warehouse::lists('name', 'id'), $data->warehouse_id,  array('class' => 'form-control'))}}
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="username">Tỉ lệ</label>
                <div class="row">
                  <div class="col-sm-6">
                    {{ Form::text('ratio', $data->ratio , textParentCategory('ratio')) }}
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
      $('#model_name').on('change', function (e) {
          var id = $('#model_name').val();
          if (id == 1) {
            var link = '/admin/api/request/all-product';
            getProduct(link);
          }
          if (id == 2) {
            var link = '/admin/api/request/all-product-category';
            getProduct(link);
          }
      });
  });
  function getProduct(link) {
    $.ajax({
      type: "GET",
      url: link,
      success: function(response){
        if(response.code == 200){                
            $('#model_id').html('');
            $.each(response.data, function (i, item) {
                $('#model_id').append($('<option>', { 
                    value: item.id,
                    text : item.name 
                }));
            });
          }
        }
    });
  }
</script>
@stop
