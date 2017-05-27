@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Cài đặt In' }}
@stop

@section('content')
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
                  {{ Form::select('code', ['' => 'Chọn'] + Company::level(4)->lists('name', 'code'), null,  array('class' => 'form-control', 'id' => 'code'))}}
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
@endif
