<link rel="stylesheet" type="text/css" href="../assets/js/combotree/themes/metro/easyui.css">
<link rel="stylesheet" type="text/css" href="../assets/js/combotree/themes/icon.css">
<link rel="stylesheet" type="text/css" href="../assets/js/combotree/demo/demo.css">
<div class="margin-bottom margin-top">
    {{ Form::open(array('action' => array('ScaleStationController@searchDetailCampaign'), 'method' => 'GET', 'id'=>'searchForm')) }}
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <label>Xuất nhập</label>
                </div>
                <div class="col-md-9">
                    {{ Form::select('transfer_type', Common::getKieuCan(), null, array('class' => 'form-control'))}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <label>Kho</label>
                </div>
                <div class="col-md-9">
                    {{ Form::select('warehouse_id', ['' => 'Chọn tất cả', ] + Warehouse::lists('name', 'id'), null,  array('class' => 'form-control'))}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <label>Chi nhánh</label>
                </div>
                <div class="col-md-9">
                    {{ Form::select('department_id', ['' => 'Chọn tất cả', ] + Company::level(4)->lists('name', 'id'), null,  array('class' => 'form-control', 'id' => 'department_id'))}}
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="padding-top: 20px">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <label>Từ ngày</label>
                </div>
                <div class="col-md-9">
                    <input class="form-control input-sm" type="text" name="from_date" id="datepicker5" value="{{ Input::old('from_date') }}">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <label>Đến ngày</label>
                </div>
                <div class="col-md-9">
                    <input class="form-control input-sm" type="text" name="to_date" id="datepicker6" value="{{ Input::old('to_date') }}">
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="padding-top: 20px">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <label>Nhóm khách hàng</label>
                </div>
                <div class="col-md-9">
                    {{ Form::select('customer_group_id', ['' => 'Chọn']+Common::getCustomerGroup(), array('class' => 'form-control')) }} 
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <label>Khách hàng</label>
                </div>
                <div class="col-md-9">
                    {{ Form::select('customer_id', ['' => 'Chọn']+Common::getCustomerList(), array('class' => 'form-control')) }} 
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <a href="{{ action('ScaleStationController@exportExcelDetailCampaign', $campaignCode) }}" class="btn btn-primary">Xuất excel</a>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}
    <div class="row" style="padding-top: 20px">
        <div class="col-md-12" style=" text-align: center;">
            <div class="form-group">
                <a href="{{ url('/admin/scale-station/statistic/campaign') }}"><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>Huỷ tìm kiếm</button></a>
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>Tìm kiếm</button>
            </div>
        </div>
    </div>

    {{ Form::close() }}
</div>
<script type="text/javascript" src="../assets/js/combotree/jquery.easyui.min.js"></script>
