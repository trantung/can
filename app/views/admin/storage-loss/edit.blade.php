@extends('admin.layout.default')

@section('title')
{{ $title='Chỉnh sửa '. getNameWarehouse($data->id) }}
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
          <div class="form-group">
            <label for="username">{{getDetailStorageLossSave($data->id)}}</label>
          </div>
            <!-- form start -->
        {{ Form::open(array('action' => array('StorageLossController@update', $data->id), 'method' => 'PUT')) }}
          <div class="box-body">
          @foreach(StorageLoss::where('warehouse_id', $data->id)->get() as $value)
            <div class="form-group">
              <div class="row">
                <div class="col-sm-6">
                <label for="username">{{ getNameByStorageLoss($value) }} {{ getNameProductOrCategory($value) }}</label>
                {{ Form::text("ratio[$value->id]", $value->ratio,array('class' => 'form-control')) }}
                </div>
              </div>
            </div>
          @endforeach
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
        console.log(111);
          var id = $('#model_name').val();
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
