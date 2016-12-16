 <!-- left column -->
    <div class="col-md-6 col-sm-6 col-xs-12">

        <div class="form-group form-group-sm row">
          {{-- <label class="col-lg-3 control-label">CMND<span class="text-danger">*</span></label> --}}
          <div class="col-xs-12">
            <input class="form-control input-sm" type="text" name="idcard" placeholder="Chứng minh nhân dân">
            {{-- <em class="text-danger">*</em> --}}
          </div>
        </div>
        {{-- id card --}}
        <div class="form-group form-group-sm row">
        <div class="col-xs-12">
            <input class="form-control input-sm" type="text" name="date_of_issue" placeholder="Ngày cấp">
        </div>
        </div>
        {{-- date_of_issue --}}
        <div class="form-group form-group-sm row">
        <div class="col-xs-12">
            <input class="form-control input-sm" type="text" name="place_of_issue" placeholder="Nơi cấp">
        </div>
        </div>
        {{-- place_of_issue --}}
        <div class="form-group form-group-sm row">
        <div class="col-xs-12">
            <input class="form-control input-sm" type="text" name="nationnality" placeholder="Quốc tịch">
        </div>
        </div>
        {{-- Nationnality --}}
        <div class="form-group form-group-sm row">
          <div class="col-xs-12">
            <select class="form-control input-sm" name="sex">
                <option value="0">Giới tính</option>
                <option value="M">Nam</option>
                <option value="W">Nữ</option>
                <option value="0">Khác</option>
            </select>
          </div>
        </div>
        {{-- sex --}}
        <div class="form-group form-group-sm row">
        <div class="col-xs-12">
            <select class="form-control input-sm" name="ethnic_group_id">
                <option value="0">Dân tộc</option>
                <option value="m">Nam</option>
                <option value="w">Nữ</option>
                <option value="t">Khác</option>
            </select>
        </div>
        </div>
        {{-- Ethnic Group --}}
        <div class="form-group form-group-sm row">
        <div class="col-xs-12">
            <select class="form-control input-sm" name="religion_category_id">
                <option value="0">Tôn giáo</option>
                <option value="m">Nam</option>
                <option value="w">Nữ</option>
                <option value="t">Khác</option>
            </select>
        </div>
        </div>
        {{-- religion --}}
        <div class="form-group form-group-sm row">
          <div class="col-xs-12">
            <select class="form-control input-sm" name="contract_category_id">
                <option value="0">Loại hợp đồng</option>
                <option value="m">Nam</option>
                <option value="w">Nữ</option>
                <option value="t">Khác</option>
            </select>
          </div>
        </div>
        {{-- contract_category --}}

    </div>
    <!-- edit form column -->
    <div class="col-md-6 col-sm-6 col-xs-12 personal-info">
        <div class="form-group form-group-sm row">
            <div class="col-xs-12">
                <input class="form-control input-sm" type="text" name="tax_code" placeholder="Mã số thuế">
            </div>
        </div>
        {{-- tax_code --}}
        <div class="form-group form-group-sm row">
            <div class="col-xs-12">
                <input class="form-control input-sm" type="text" name="insurance_id" placeholder="Số sổ bảo hiểm y tế">
            </div>
        </div>
        {{-- insurance_id --}}
        <div class="form-group form-group-sm row">
        <div class="col-xs-12">
            <input class="form-control input-sm" type="text" name="bank_id" placeholder="Số tài khoản ngân hàng">
        </div>
        </div>
        {{-- tax_code --}}
         <div class="form-group form-group-sm row">
         <div class="col-xs-12">
            <input class="form-control input-sm" type="text" name="bank_name" placeholder="Ngân hàng">
        </div>
        </div>
        {{-- bank name --}}

        {{-- <div class="form-group form-group-sm row">
           <div class="col-xs-12">
            <select class="form-control input-sm" name="company_id">
                <option value="0">Công ty</option>
                <option value="m">Nam</option>
                <option value="w">Nữ</option>
                <option value="t">Khác</option>
            </select>
          </div>
        </div> --}}
        {{-- company_name --}}
        <div class="form-group form-group-sm row">
          <div class="col-xs-12">
            <select class="form-control input-sm" name="branch_category_id">
                <option value="0">Chi nhánh</option>
                <option value="m">Nam</option>
                <option value="w">Nữ</option>
                <option value="t">Khác</option>
            </select>
          </div>
        </div>
        {{-- branch --}}
        <div class="form-group form-group-sm row">
           <div class="col-xs-12">
            <select class="form-control input-sm" name="position_category_idF">
                <option value="0">Chức vụ</option>
                <option value="m">Lao động phổ thông Full time</option>
                <option value="w">Lao động phổ thông parttime</option>
                <option value="t">Chuyên viên</option>
            </select>
          </div>
        </div>
        {{-- position --}}
        <div class="form-group form-group-sm row">
           <div class="col-xs-12">
            <select class="form-control input-sm" name="employees_category_id">
                <option value="0">Loại nhân viên</option>
                <option value="m">Lao động phổ thông Full time</option>
                <option value="w">Lao động phổ thông parttime</option>
                <option value="t">Chuyên viên</option>
            </select>
          </div>
        </div>
        {{-- personal_category --}}


         <div class="form-group form-group-sm row">
            <div class="col-xs-12">
            <input type="submit" class="btn btn-primary" value="Thêm mới">
            </div>
        </div>
    </div>