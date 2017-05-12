@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Thêm mới' }}
@stop

@section('content')

<div class="row margin-bottom">
  <div class="col-xs-12">
    <a href="{{ action('ProductionAutoController@index') }}" class="btn btn-success">Danh sách</a>
  </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
        <!-- form start -->
        {{ Form::open(array('action' => 'ProductionAutoController@store')) }}
          <div class="box-body">
            <div class="form-group">
              <label for="username">Chi nhánh</label>
              <div class="row">
                <div class="col-sm-6">
                  {{ Form::select('department_id', ['' => 'Chọn'] + Company::level(3)->lists('name', 'id'), null,  array('class' => 'form-control', 'id' => 'department_id'))}}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Kho</label>
              <div class="row">
                <div class="col-sm-6">
                  {{ Form::select('warehouse_id', ['' => 'Chọn'], null,  array('class' => 'form-control', 'id' => 'warehouse_id'))}}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Nguyên liệu</label>
              <div class="row">
                <div class="col-sm-6">
                  {{ Form::select('product_category_id', ['' => 'Chọn'] + ProductCategory::lists('name', 'id'), null,  array('class' => 'form-control', 'id' => 'product_category_id'))}}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Thành phẩm</label>
              <div class="row">
                <div class="col-sm-6">
                  {{ Form::select('product_id', ['' => 'Chọn'] + Product::lists('name', 'id'), null,  array('class' => 'form-control', 'id' => 'product_id'))}}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Hao hụt lưu kho</label>
              <div class="row">
                <div class="col-sm-6 storage-loss">
                  {{Form::hidden('storage_loss', null,  array('id' => 'storage_loss'))}}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Khối lượng nguyên liệu</label>
              <div class="row">
                <div class="col-sm-6">
                  {{ Form::text('product_category_weight', null,  array('class' => 'form-control', 'id' => 'product_category_weight'))}}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Hao hụt sản xuất</label>
              <div class="row">
                <div class="col-sm-6 production-loss">
                  {{Form::hidden('production_loss', null,  array('id' => 'production_loss'))}}
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
      $('#department_id').on('change', function (e) {
          var id = $('#department_id').val();
          if (id != 0) {
            getWarehouse(id);
          }
      });
      $('#product_id').on('change', function (e) {
        var productId = $('#product_id').val();
        var productCategoryId = $('#product_category_id').val();
        getStorageLoss(productCategoryId, productId);
      });
      $("#product_category_weight").keyup(function(){
        var productId = $('#product_id').val();
        var productCategoryId = $('#product_category_id').val();
        var warehouseId = $('#warehouse_id').val();
        var weight = $('#product_category_weight').val();
        getProductionLoss(productCategoryId, productId, weight, warehouseId);
      });
  });
  function getWarehouse(id) {
    $.ajax({
      type: "GET",
      url: '/admin/api/warehouse-by-department/' + id,
      success: function(response){
            $('#warehouse_id').html('');
            $.each(response, function (i, item) {
                $('#warehouse_id').append($('<option>', { 
                    value: item.id,
                    text : item.name 
                }));
            });
        }
    });
  }
  function getStorageLoss(productCategoryId, productId) {
    $.ajax({
      type: "GET",
      url: '/api/request/storage-loss/' + productCategoryId + '/' + productId,
      success: function(response){
        if (response.code == 200) {
          $('.storage-loss').html(response.data + ' %');
          $('#storage_loss').val(response.data);
        }
      }
    });
  }
  function getProductionLoss(productCategoryId, productId, weight, warehouseId) {
    $.ajax({
      type: "GET",
      url: '/api/request/production-loss/' + productCategoryId + '/' + productId + '/' + weight + '/' + warehouseId,
      success: function(response){
        if (response.code == 200) {
          $('.production-loss').html(response.data + ' %');
          $('#production_loss').val(response.data);
        } else {
          $('.production-loss').html('Không có hao hụt kho');
        }
      }
    });
  }
</script>
@stop
@endif