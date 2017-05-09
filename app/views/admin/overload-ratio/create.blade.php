@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Thêm mới' }}
@stop

@section('content')

<div class="row margin-bottom">
  <div class="col-xs-12">
    <a href="{{ action('OverloadRatioController@index') }}" class="btn btn-success">Danh sách</a>
  </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
        <!-- form start -->
        {{ Form::open(array('action' => 'OverloadRatioController@store')) }}
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
            <?php $index = 0; ?>
            <div id="row-promotion">
              <div class="form-group config-data" data-row="<?= $index; ?>">
                <label for="username">Tên</label>
                <div class="row">
                  <div class="col-sm-6">
                      <input type="text" class="form-control" name="key[{{ $index }}]" value="{{Input::old('name')}}">
                  </div>
                  <div class="col-sm-6">
                      <input type="text" class="form-control" name="value[{{ $index }}]" value="{{Input::old('name')}}">
                  </div>
                </div>
              </div>
            </div>
            <a class="add-config btn btn-primary">Thêm</a>
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
            var link = '/admin/api/request/all-product';
            getProduct(link);
          }
          if (id == 'ProductCategory') {
            var link = '/admin/api/request/all-product-category';
            getProduct(link);
          }
      });
      var i = 0;
      $( ".add-config" ).click(function() {
        i++;
        $("#row-promotion > div:last-child").clone()
            .attr('data-row', i)
            .appendTo('#row-promotion');
        var lastRow = $("#row-promotion > div:last-child :input");
        var field = [ 'key', 'value'];
        $.each(lastRow, function (index, item) {
            $(lastRow[index]).attr('name', field[index] + '[' + i + ']').val('');
        });
          
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