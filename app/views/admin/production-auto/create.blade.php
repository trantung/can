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
                  {{ Form::select('product_category_id', ['' => 'Chọn'] + ProductCategory::lists('name', 'id'), null,  array('class' => 'form-control', 'id' => 'department_id'))}}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Thành phẩm</label>
              <div class="row">
                <div class="col-sm-6">
                  {{ Form::select('product_id', ['' => 'Chọn'] + Product::lists('name', 'id'), null,  array('class' => 'form-control', 'id' => 'department_id'))}}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="username">Tên</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="name" name="name" value="{{Input::old('name')}}">
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
</script>
@stop
@endif