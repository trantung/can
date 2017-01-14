 <!-- left column -->
    <div class="col-md-6 col-sm-6 col-xs-12">

        <div class="form-group form-group-sm row">
          {{-- <label class="col-lg-3 control-label">CMND<span class="text-danger">*</span></label> --}}
          <div class="col-xs-12">
          <label class="control-label">Chứng minh nhân dân</label>
            <input class="form-control input-sm" type="text" name="idcard" placeholder="Chứng minh nhân dân"  value="{{$personal->idcard}}">
            {{-- <em class="text-danger">*</em> --}}
          </div>
        </div>
        {{-- id card --}}
        <div class="form-group form-group-sm row">
        <div class="col-xs-12">
        <label class="control-label">Ngày cấp</label>
            <input class="form-control input-sm" type="text" name="date_of_issue" placeholder="Ngày cấp" value="{{$personal->date_of_issue}}" id="datepickerEnddate" >
        </div>
        </div>
        {{-- date_of_issue --}}
        <div class="form-group form-group-sm row">
        <div class="col-xs-12">
        <label class="control-label">Nơi cấp</label>
            <input class="form-control input-sm" type="text" name="place_of_issue" placeholder="Nơi cấp" value="{{$personal->place_of_issue}}">
        </div>
        </div>
        {{-- place_of_issue --}}
        <div class="form-group form-group-sm row">
        <div class="col-xs-12">
            <label class="control-label">Quốc tịch</label>
            {{ Form::select('nationality_category_id', $nationality_category_id, $personal->nationality_category_id, array('class'=>'form-control input-sm')) }}
        </div>
        </div>
        {{-- Nationnality --}}
        <div class="form-group form-group-sm row">
          <div class="col-xs-12">
            <label class="control-label">Giới tính</label>
            {{ Form::select('sex', getSex(), $personal->sex, array('class'=>'form-control input-sm')) }}

          </div>
        </div>
        {{-- sex --}}
        <div class="form-group form-group-sm row">
            <div class="col-xs-12">
            <label class="control-label">Dân tộc</label>
            {{ Form::select('ethnic_group_id', $ethnic_group_id, $personal->ethnic_group_id, array('class'=>'form-control input-sm')) }}
            </div>
        </div>
        {{-- Ethnic Group --}}
        <div class="form-group form-group-sm row">
        <div class="col-xs-12">
        <label class="control-label">Tôn giáo</label>
            {{ Form::select('religion_category_id', $religion_category_id, $personal->religion_category_id, array('class'=>'form-control input-sm')) }}
        </div>
        </div>
        {{-- religion --}}
        <div class="form-group form-group-sm row">
          <div class="col-xs-12">
          <label class="control-label">Loại hợp đồng</label>
             {{ Form::select('contract_category_id', $contract_category_id, $personal->contract_category_id, array('class'=>'form-control input-sm')) }}
          </div>
        </div>
        {{-- contract_category --}}

    </div>
    <!-- edit form column -->
    <div class="col-md-6 col-sm-6 col-xs-12 personal-info">
        <div class="form-group form-group-sm row">
            <div class="col-xs-12">
            <label class="control-label">Mã số thuế</label>
                <input class="form-control input-sm" type="text" name="tax_code" placeholder="Mã số thuế" value="{{$personal->tax_code}}">
            </div>
        </div>
        {{-- tax_code --}}
        <div class="form-group form-group-sm row">
            <div class="col-xs-12">
            <label class="control-label">Số sổ bảo hiểm y tế</label>
                <input class="form-control input-sm" type="text" name="insurance_id" placeholder="Số sổ bảo hiểm y tế" value="{{$personal->insurance_id}}">
            </div>
        </div>
        {{-- insurance_id --}}
        <div class="form-group form-group-sm row">
        <div class="col-xs-12">
        <label class="control-label">Số tài khoản ngân hàng</label>
            <input class="form-control input-sm" type="text" name="bank_id" placeholder="Số tài khoản ngân hàng" value="{{$personal->bank_id}}">
        </div>
        </div>
        {{-- tax_code --}}
         <div class="form-group form-group-sm row">
         <div class="col-xs-12">
         <label class="control-label">Ngân hàng</label>
            <input class="form-control input-sm" type="text" name="bank_name" placeholder="Ngân hàng" value="{{$personal->bank_name}}">
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
          <label class="control-label">Chi nhánh</label>
            {{ Form::select('branch_category_id', $company_category_id, $personal->branch_category_id, array('class'=>'form-control input-sm', 'id'=>'section_branch')) }}
          </div>
        </div>
        {{-- branch --}}
        <div class="form-group form-group-sm row">
           <div class="col-xs-12">
           <label class="control-label">Vị trí hiện tại</label>
            {{ Form::select('position_category_id', $position_category_id, $personal->position_category_id, array('class'=>'form-control input-sm','id'=>'section_position')) }}
          </div>
        </div>
        {{-- position --}}
        <div class="form-group form-group-sm row">
           <div class="col-xs-12">
           <label class="control-label">Loại nhân viên</label>
            {{ Form::select('employees_category_id', $employees_category_id, $personal->employees_category_id, array('class'=>'form-control input-sm')) }}
          </div>
        </div>
        {{-- personal_category --}}


         <div class="form-group form-group-sm row">
            <div class="col-xs-12">
            <input type="submit" class="btn btn-primary" value="Thêm mới">
            </div>
        </div>
    </div>