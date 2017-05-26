@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Thêm mới' }}
@stop

@section('content')

<div class="row margin-bottom">
  <div class="col-xs-12">
    <a href="{{ action('StorageLossController@index') }}" class="btn btn-success">Danh sách</a>
  </div>
</div>

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
                  {{ Form::select('model_name', ['' => 'Chọn', 'ProductCategory' => 'Nguyên liệu thô', 'Product' => 'Thành phẩm'], null,  array('class' => 'form-control', 'id' => 'model_name'))}}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Sản phẩm</label>
              <div class="row">
                <div class="col-sm-6">
                  {{ Form::select('model_id', ['' => 'Chọn'], null,  array('class' => 'form-control', 'id' => 'model_id'))}}
                </div>
              </div>
            </div>
           
            <div class="form-group">
              <label for="username">Kho</label>
              <div class="row">
                <div class="col-sm-6">
                  {{ Form::select('warehouse_id', ['' => 'Chọn'] + Warehouse::lists('name', 'id'), null,  array('class' => 'form-control'))}}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Tỉ lệ</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="ratio" name="ratio" value="{{Input::old('ratio')}}">
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
          if (id == 0) {
            $('#model_id').html('');
          }
          if (id == 'Product') {
            var link = '/api/request/all-product';
            getProduct(link);
          }
          if (id == 'ProductCategory') {
            var link = '/api/request/all-product-category';
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
@endif