<div class="row">
    <div class="col-xs-12">
    <h3>Lịch sử công tác <span><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewEmployerHistory">Thêm mới</button></span></h3>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="well well-lg">
                <h4><b>Công ty TNHH Duck VI</b></h4>
                14/1/2016  <b>-</b> 14/10/2016 </br>
                Vị trí: ky su </br>
                Lý do chuyển công tác: 2010 </br>
                Ghi chú: something
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="well well-lg">
                <h4><b>Công ty TNHH Duck I</b></h4>
                14/1/2016  <b>-</b> 14/10/2016 </br>
                Vị trí: ky su </br>
                Lý do chuyển công tác: 2010 </br>
                Ghi chú: something
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="well well-lg">
               <h4><b>Công ty TNHH Duck II</b></h4>
                14/1/2016  <b>-</b> 14/10/2016 </br>
                Vị trí: ky su </br>
                Lý do chuyển công tác: 2010 </br>
                Ghi chú: something
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="well well-lg">
                <h4><b>Công ty TNHH Dusk </b></h4>
                14/10/2016  <b>-</b> đến nay </br>
                Chức vụ: ky su </br>
            </div>
        </div>

    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">


            </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="addNewEmployerHistory" tabindex="-1" role="dialog" aria-labelledby="addNewEmployerHistoryLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="addNewEmployerHistoryLabel">Thêm mới lịch sử công tác </h4>
      </div>
      <div class="modal-body">
            <form action="" method="post" accept-charset="utf-8">
                <div class="well well-lg">
                    <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Công ty<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input class="form-control input-sm" type="text" name="company_name" placeholder="Tên công ty">
                        </div>
                    </div>
                    {{-- company name --}}
                    <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Vị trí<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <select class="form-control input-sm" name="position">
                                <option value="0">--</option>
                                <option value="1">CNTT</option>
                                <option value="2">BIO</option>
                                <option value="3">Other</option>
                            </select>
                        </div>
                    </div>
                    {{-- position--}}
                   <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Lý do chuyển công tác<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input class="form-control input-sm" type="text" name="why_out" placeholder="Lý do chuyển công tác">
                        </div>
                    </div>
                    {{-- why out --}}
                    <div class="form-group form-group-sm row">
                        <label class=" col-lg-3 control-label">Ghi chú</label>
                        <div class="col-lg-8">
                            <textarea  class="form-control input-sm" type="text" name="description" placeholder="Ghi chú"></textarea>
                        </div>
                    </div>
                    {{-- company name --}}
                </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
        <button type="button" class="btn btn-primary">Thêm mới</button>
      </div>
    </div>
  </div>
</div>