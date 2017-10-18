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
              <label for="username">Mã phiếu</label>
              <div class="row">
                <div class="col-sm-6 production-loss-department_id">
                </div>
                <div class="col-sm-6">
                  <input type="hidden" name="production-loss-department_id" id="production-loss-department_id" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Chi nhánh</label>
              <div class="row">
                <div class="col-sm-6">
                  {{ Form::select('department_id', ['' => 'Chọn'] + Company::level(4)->lists('name', 'id'), null,  array('class' => 'form-control', 'id' => 'department_id'))}}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Kho nguyên liệu</label>
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
              <label for="username">Hao hụt sản xuất</label>
              <div class="row">
                <div class="col-sm-6 production-loss">
                </div>
                <div class="col-sm-6">
                <input type="hidden" name="product_loss_id" id="product_loss_id" class="form-control">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="username">Khối lượng trong kho</label>
              <div class="row">
                <div class="col-sm-6 production-auto_weight_stock">
                </div>
                <div class="col-sm-6">
                  <input type="hidden" name="production-auto_weight_stock" id="production-auto_weight_stock" class="form-control">
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
              <label for="username">Kho thành phẩm</label>
              <div class="row">
                <div class="col-sm-6">
                  {{ Form::select('warehouse_output_id', ['' => 'Chọn'], null,  array('class' => 'form-control', 'id' => 'warehouse_output_id'))}}
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="username">Hao hụt lưu kho</label>
              <div class="row">
                <div class="col-sm-6 storage-loss">
                </div>
                <div class="col-sm-6">
                <input type="hidden" name="storage_loss_id" id="storage_loss_id" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Kết quả</label>
              <div class="row">
                <div class="col-sm-6 result">
                </div>
                <div class="col-sm-6">
                  <input type="hidden" name="product_weight" id="product_weight" class="form-control">
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
          getProductionCode(id);
          if (id != 0) {
            getWarehouse(id);
          }
      });
      $('#product_id').on('change', function (e) {
        var productId = $('#product_id').val();
        var productCategoryId = $('#product_category_id').val();
        getProductionLoss(productCategoryId, productId);
      });

      $('#product_category_id, #warehouse_id').on('change', function (e) {
        var productCategoryId = $('#product_category_id').val();
        var productionAutoWeightStock = $('#warehouse_id').val();
        if (productCategoryId != '' && productionAutoWeightStock != '') {
          getProductionAutoWeightStock(productionAutoWeightStock, productCategoryId);
        };
      });

      // $("#product_category_weight").keyup(function(){
      $('#warehouse_output_id').on('change', function (e) {
        setTimeout(function(){
          var productId = $('#product_id').val();
          var productCategoryId = $('#product_category_id').val();
          var warehouseId = $('#warehouse_id').val();
          var weight = $('#product_category_weight').val();
          var warehouse_output_id = $('#warehouse_output_id').val();
          getStorageLoss(warehouse_output_id, productId);
          getResultProductionAuto(productCategoryId, productId, weight, warehouseId, warehouse_output_id);
        }, 500);
      });
      // $('#warehouse_output_id').on('change', function (e) {
      //     var id = $('#warehouse_output_id').val();
      //     var productId = $('#product_id').val();
      //     console.log("productId", productId);
      //     if (id != 0) {
      //       getStorageLoss(id, productId);
      //     }
      // });
      // $('.production-loss-department_id').on('change', function (e) {
      //   var departmentId = $('.production-loss-department_id').val();
      //   getProductionCode(departmentId);
      // });
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
            $('#warehouse_output_id').html('');
            $.each(response, function (i, item) {
                $('#warehouse_output_id').append($('<option>', { 
                    value: item.id,
                    text : item.name 
                }));
            });
        }
    });
  }
  function getProductionLoss(productCategoryId, productId) {
    console.log(productCategoryId);
    $.ajax({
      type: "GET",
      url: '/api/request/production-loss/' + productCategoryId + '/' + productId,
      success: function(response){
        if (response.code == 200) {
          $('.production-loss').html(response.data + ' %');
          $('#product_loss_id').val(response.data);
        }
      }
    });
  }
  function getProductionCode(departmentId) {
    $.ajax({
      type: "GET",
      url: '/api/request/production-loss-department/' + departmentId,
      success: function(response){
        if (response.code == 200) {
          $('.production-loss-department_id').html(response.data );
          $('#production-loss-department_id').val(response.data);
        }
      }
    });
  }
  function getProductionAutoWeightStock(warehouseId, productCategoryId) {
    console.log(productCategoryId);
    $.ajax({
      type: "GET",
      url: '/api/request/production-auto-weight-stock/' + warehouseId + '/' + productCategoryId,
      success: function(response){
        if (response.code == 200) {
          $('.production-auto_weight_stock').html(response.data_format );
          $('#production-auto_weight_stock').val(response.data);
        }
      }
    });
  }
  
  function getStorageLoss(id, productId) {
    $.ajax({
      type: "GET",
      url: '/api/request/storage-loss/' + id + '/' + productId,
      success: function(response){
        if (response.code == 200) {
          $('.storage-loss').html(response.data + ' %');
          $('#storage_loss_id').val(response.data);
        }
      }
    });
  }
  function getResultProductionAuto(productCategoryId, productId, weight, warehouseId, warehouse_output_id) {
    $.ajax({
      type: "GET",
      url: '/api/request/result-production-auto/' + productCategoryId + '/' + productId + '/' + weight + '/' + warehouseId + '/' + warehouse_output_id,
      success: function(response){
        if (response.code == 200) {
          $('.result').html(response.data + 'kg');
          $('#product_weight').val(response.data);
        } else {
          $('.result').html('Không có hao hụt kho');
        }
      }
    });
  }
</script>
@stop
@endif