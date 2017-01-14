 <!-- left column -->
    <div class="col-md-6 col-sm-6 col-xs-12">

        <div class="form-group form-group-sm row">
          {{-- <label class="col-lg-3 control-label">CMND<span class="text-danger">*</span></label> --}}
          <div class="col-xs-12">
            <input class="form-control input-sm" type="text" name="idcard" value="{{Input::old('idcard')}}" placeholder="Chứng minh nhân dân" >
            {{-- <em class="text-danger">*</em> --}}
          </div>
        </div>
        {{-- id card --}}
        <div class="form-group form-group-sm row">
        <div class="col-xs-12">
            <input class="form-control input-sm" type="text" name="date_of_issue" value="{{Input::old('date_of_issue')}}"  placeholder="Ngày cấp"  id="datepickerEnddate" >
        </div>
        </div>
        {{-- date_of_issue --}}
        <div class="form-group form-group-sm row">
        <div class="col-xs-12">
            <input class="form-control input-sm" type="text" name="place_of_issue " value="{{Input::old('place_of_issue')}}"  placeholder="Nơi cấp" >
        </div>
        </div>
        {{-- place_of_issue --}}
        <div class="form-group form-group-sm row">
        <div class="col-xs-12">
            {{ Form::select('nationality_category_id', $nationality_category_id, Input::old('nationality_category_id'), array('class'=>'form-control input-sm')) }}
        </div>
        </div>
        {{-- Nationnality --}}
        <div class="form-group form-group-sm row">
          <div class="col-xs-12">
            {{ Form::select('sex', getSex(), Input::old('sex'), array('class'=>'form-control input-sm')) }}

          </div>
        </div>
        {{-- sex --}}
        <div class="form-group form-group-sm row">
        <div class="col-xs-12">
        {{ Form::select('ethnic_group_id', $ethnic_group_id, Input::old('ethnic_group_id'), array('class'=>'form-control input-sm')) }}
        </div>
        </div>
        {{-- Ethnic Group --}}
        <div class="form-group form-group-sm row">
        <div class="col-xs-12">
            {{ Form::select('religion_category_id', $religion_category_id, Input::old('religion_category_id'), array('class'=>'form-control input-sm')) }}
        </div>
        </div>
        {{-- religion --}}
        <div class="form-group form-group-sm row">
          <div class="col-xs-12">
             {{ Form::select('contract_category_id', $contract_category_id, Input::old('contract_category_id'), array('class'=>'form-control input-sm')) }}
          </div>
        </div>
        {{-- contract_category --}}

    </div>
    <!-- edit form column -->
    <div class="col-md-6 col-sm-6 col-xs-12 personal-info">
        <div class="form-group form-group-sm row">
            <div class="col-xs-12">
                <input class="form-control input-sm" type="text" value="{{Input::old('tax_code')}}"  name="tax_code" placeholder="Mã số thuế">
            </div>
        </div>
        {{-- tax_code --}}
        <div class="form-group form-group-sm row">
            <div class="col-xs-12">
                <input class="form-control input-sm" type="text" value="{{Input::old('insurance_id')}}"  name="insurance_id" placeholder="Số sổ bảo hiểm y tế">
            </div>
        </div>
        {{-- insurance_id --}}
        <div class="form-group form-group-sm row">
        <div class="col-xs-12">
            <input class="form-control input-sm" type="text" value="{{Input::old('bank_id')}}"  name="bank_id" placeholder="Số tài khoản ngân hàng">
        </div>
        </div>
        {{-- tax_code --}}
         <div class="form-group form-group-sm row">
         <div class="col-xs-12">
            <input class="form-control input-sm" type="text" value="{{Input::old('bank_name')}}"  name="bank_name" placeholder="Ngân hàng">
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
            {{ Form::select('branch_category_id', $company_category_id, Input::old(''), array('class'=>'form-control input-sm', 'id'=>'section_branch')) }}
          </div>
        </div>
        {{-- branch --}}
        <div class="form-group form-group-sm row">
           <div class="col-xs-12">
            {{ Form::select('position_category_id', $position_category_id, Input::old(''), array('class'=>'form-control input-sm', 'id'=>'section_position')) }}
          </div>
        </div>
        {{-- position --}}
        <div class="form-group form-group-sm row">
           <div class="col-xs-12">
            {{ Form::select('employees_category_id', $employees_category_id, Input::old('employees_category_id'), array('class'=>'form-control input-sm')) }}
          </div>
        </div>
        {{-- personal_category --}}


         <div class="form-group form-group-sm row">
            <div class="col-xs-12">
            <input type="submit" class="btn btn-primary" value="Thêm mới">
            </div>
        </div>
    </div>