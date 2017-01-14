<div class="margin-bottom">
    {{ Form::open(array('action' => 'HumanResourcesController@index', 'method' => 'GET')) }}
        <div class="input-group" style="width: 150px; display:inline-block;">
            <label>Từ khóa</label>
            <input type="text" name="keyword" class="form-control" placeholder="Search" />
        </div>
        <div class="input-group" style="width: 150px; display:inline-block;">
            <label>Dân tộc</label>
            {{ Form::select('ethnic_group_id', $ethnic_group_id, null, array('class' =>'form-control')) }}
        </div>
        <div class="input-group" style="width: 150px; display:inline-block;">
            <label>Tôn giáo</label>
            {{ Form::select('religion_category_id', $religion_category_id, null, array('class' =>'form-control')) }}
        </div>
        <div class="input-group" style="width: 150px; display:inline-block;">
            <label>Loại hợp đồng</label>
            {{ Form::select('contract_category_id', $contract_category_id, null, array('class' =>'form-control')) }}
        </div>
        <div class="input-group" style="width: 150px; display:inline-block;">
            <label>Cow cau to chuc</label>
            {{ Form::select('branch_category_id', $company_category_id, null, array('class' =>'form-control')) }}
        </div>
        <div class="input-group" style="width: 150px; display:inline-block;">
            <label>Chức danh</label>
            {{ Form::select('position_category_id', $position_category_id, null, array('class' =>'form-control')) }}
        </div>
        {{-- <div class="input-group" style="width: 150px; display:inline-block;">
            <label>Loại lao động</label>
            {{ Form::select('employees_category_id', $employees_category_id, null, array('class' =>'form-control')) }}
        </div> --}}
        <div class="input-group" style="width: 150px; display:inline-block;">
            <label>Quốc gia</label>
            {{ Form::select('nationality_category_id', $nationality_category_id, null, array('class' =>'form-control')) }}
        </div>
        <div class="input-group" style="width: 150px; display:inline-block;">
            <label>ngành nghề</label>
            {{ Form::select('industry_category_id', $industry_category_id, null, array('class' =>'form-control')) }}
        </div>
        <div class="input-group" style="width: 150px; display:inline-block;">
            <label>Bằng cấp</label>
            {{ Form::select('certificate_category_id', $certificate_category_id, null, array('class' =>'form-control')) }}
        </div>

        {{-- <div class="input-group" style="width: 150px; display:inline-block;">
            <label>Ngày tạo</label>
            <input type="text" name="created_at" class="form-control" id="datepickerStartdate" placeholder="Từ ngày" />
        </div> --}}

        <div class="input-group" style="display: inline-block; vertical-align: bottom;">
            <input type="submit" value="Search" class="btn btn-primary" />
        </div>
    {{ Form::close() }}
</div>