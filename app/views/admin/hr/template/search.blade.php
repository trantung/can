<div class="margin-bottom margin-top">
    {{ Form::open(array('action' => 'HumanResourcesController@index', 'method' => 'GET')) }}
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <label>Từ khóa</label>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <input type="text" name="keyword" class="form-control" placeholder="Search" value="{{Input::old('keyword')}}" />
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <label>Nơi sinh</label>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        {{ Form::select('noi_sinh', $thanh_pho, Input::old('noi_sinh'), array('class' =>'form-control')) }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <label>Chức danh</label>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        {{ Form::select('vi_tri', $vi_tri, Input::old('vi_tri'), array('class' =>'form-control')) }}
                    </div>
                </div>
            </div>
        </div>

    </div>


        {{-- <div class="input-group" style="width: 150px; display:inline-block;">
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
        </div> --}}
        {{-- <div class="input-group" style="width: 150px; display:inline-block;">
            <label>Loại lao động</label>
            {{ Form::select('employees_category_id', $employees_category_id, null, array('class' =>'form-control')) }}
        </div> --}}
       {{--  <div class="input-group" style="width: 150px; display:inline-block;">
            <label>Quốc gia</label>
            {{ Form::select('nationality_category_id', $nationality_category_id, null, array('class' =>'form-control')) }}
        </div> --}}
        {{-- <div class="input-group" style="width: 150px; display:inline-block;">
            <label>ngành nghề</label>
            {{ Form::select('industry_category_id', $industry_category_id, null, array('class' =>'form-control')) }}
        </div>
        <div class="input-group" style="width: 150px; display:inline-block;">
            <label>Bằng cấp</label>
            {{ Form::select('certificate_category_id', $certificate_category_id, null, array('class' =>'form-control')) }}
        </div> --}}

        {{-- <div class="input-group" style="width: 150px; display:inline-block;">
            <label>Ngày tạo</label>
            <input type="text" name="created_at" class="form-control" id="datepickerStartdate" placeholder="Từ ngày" />
        </div> --}}
        <div class="row">
            <div class="col-md-12" style=" text-align: right;">
                <div class="form-group">
                    <input type="submit" value="Search" class="btn btn-primary" />
                </div>
            </div>
        </div>

    {{ Form::close() }}
</div>