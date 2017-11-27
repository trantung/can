@extends('admin.layout.default')
@section('title')
{{ $title='Cài đặt In' }}
@stop

@section('content')
@include('admin.scale-station.template.scale-export-js')
  <hr>
  {{-- haind --}}
  <form id="searchExport">
  <div class="row">
      <div class="col-md-4">
          <div class="row">
              <div class="col-md-3">
                  <label>Công ty</label>
              </div>
              <div class="col-md-9">
                  {{ Form::select('company_id', ['' => 'Chọn'] + Company::level(3)->lists('name', 'id'), null,  array('class' => 'form-control', 'id' => 'company_id'))}}
              </div>
          </div>
      </div>
      <div class="col-md-4">
          <div class="row">
              <div class="col-md-3">
                  <label>Chi nhánh</label>
              </div>
              <div class="col-md-9">
                  {{ Form::select('department_id', ['' => 'Chọn tất cả', ] + Company::level(4)->lists('name', 'id'), Input::get('department_id'),  array('class' => 'form-control', 'id' => 'department_id'))}}
              </div>
          </div>
      </div>
      <div class="col-md-4">
          <div class="row">
              <div class="col-md-3">
                  <label>Trạm cân</label>
              </div>
              <div class="col-md-9">
                  <?php $scaleList = ScaleStation::select(['department_id', 'id', 'name'])->get(); ?>
                  <select name="code" id="code" class="form-control">
                      <option value="">Chọn tất cả</option>
                      @foreach ($scaleList as $key => $value)
                          <option style="display:{{ (Input::get('department_id') != $value->department_id ) ? 'none' : 'block' }}" {{ (Input::get('code') == $value->id ) ? 'selected' : '' }} department-id="{{ $value->department_id }}" value="{{ $value->id }}">{{ $value->name }}</option>
                      @endforeach
                  </select>
              </div>
          </div>
      </div>
  </div>
  <div class="row" style="padding-top: 20px">
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-3">
                <label>Tìm kiếm theo</label>
            </div>
            <div class="col-md-9">
                {{ Form::select('type_search', ['1' => 'Số phiếu', '2' => 'Mã chiến dịch'], null,  array('class' => 'form-control', 'id' => 'type_search'))}}
            </div>
        </div>
    </div>
    <div class="col-md-4">
          <div class="row">
              <div class="col-md-3">
              </div>
              <div class="col-md-9">
                  <input type="text" name="search" class="form-control" placeholder="Search"/>
              </div>
          </div>
      </div>
  </div>
  {{-- end --}}
  <div class="row" style="padding-top: 20px">
      <div class="col-md-12" style=" text-align: center;">
          <div class="form-group">
            <button type="button" class="btn btn-default" id="export-pdf">In PDF</button>
          </div>
      </div>
  </div>
  </form>
<script type="text/javascript">
  $(document).ready(function () {
    $('#company_id').on('change', function (e) {
        var id = $('#company_id').val();
        if (id != 0) {
          // getDepartment(id, productId);
        }
    });
    $('#export-pdf').click(function(){
        var form = $('#searchExport').serialize();
        window.open('export?' + form,'_blank');
    });
  });
  // function getDepartment(productCategoryId, productId) {
  //   $.ajax({
  //     type: "GET",
  //     url: '/api/request/production-loss/' + productCategoryId + '/' + productId,
  //     success: function(response){
  //       if (response.code == 200) {
  //         $('.production-loss').html(response.data + ' %');
  //         $('#product_loss_id').val(response.data);
  //       }
  //     }
  //   });
  // }
</script>
@stop
