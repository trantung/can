<div class="row">
    <div class="col-xs-12">
    <h3>Trình độ học vấn <span><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewSchool">Thêm mới</button></span></h3>

        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="well well-lg">
                    <h4><b>Trường : abc </b></h4>
                    Ngành học: cntt </br>
                    Học vị: ky su </br>
                    Năm tốt nghiệp: 2010 </br>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="well well-lg">
                    <h4><b>Trường : abc </b></h4>
                    Ngành học: cntt </br>
                    Học vị: ky su </br>
                    Năm tốt nghiệp: 2010 </br>
                </div>
            </div>

        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addNewSchool" tabindex="-1" role="dialog" aria-labelledby="addNewSchoolLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="addNewSchoolLabel">Thêm mới trường đã học</h4>
      </div>
      <div class="modal-body">
            <form action="" method="post" accept-charset="utf-8">
                <div class="well well-lg">
                    <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Trường<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input class="form-control input-sm" type="text" name="school_name" placeholder="Tên trường">
                        </div>
                    </div>
                    {{-- school name --}}
                    <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Ngành học<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <select class="form-control input-sm" name="industry_id">
                                <option value="0">--</option>
                                <option value="1">CNTT</option>
                                <option value="2">BIO</option>
                                <option value="3">Other</option>
                            </select>
                        </div>
                    </div>
                    {{-- industry id--}}
                    <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Ngành học<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <select class="form-control input-sm" name="certificate_id">
                                <option value="0">--</option>
                                <option value="1">CNTT</option>
                                <option value="2">BIO</option>
                                <option value="3">Other</option>
                            </select>
                        </div>
                    </div>
                    {{-- certificate id--}}
                    <div class="form-group form-group-sm row">
                        <label class="col-lg-3 control-label">Năm tốt nghiệp<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <select class="form-control input-sm" name="graduation_year">
                                <option value="0">--</option>
                                <option value="1">CNTT</option>
                                <option value="2">BIO</option>
                                <option value="3">Other</option>
                            </select>
                        </div>
                    </div>
                    {{-- graduation year--}}
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