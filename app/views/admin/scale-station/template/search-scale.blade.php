<link rel="stylesheet" type="text/css" href="../assets/js/combotree/themes/metro/easyui.css">
<link rel="stylesheet" type="text/css" href="../assets/js/combotree/themes/icon.css">
<link rel="stylesheet" type="text/css" href="../assets/js/combotree/demo/demo.css">
<div class="margin-bottom margin-top">
    {{ Form::open(array('action' => array('ScaleStationController@getStatistic', $type), 'method' => 'GET', 'id'=>'searchForm')) }}
    {{-- haind --}}
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <label>Số phiếu</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="number_ticket" class="form-control" placeholder="Search"/>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <label>Xuất nhập</label>
                </div>
                <div class="col-md-9">
                    {{ Form::select('transfer_type', [ '' => 'Chọn tất cả', 1 => 'Xuất kho', 2 => 'Nhập kho', 3 => 'Chuyển xuất', 4 => 'Chuyển nhập'] , null,  array('class' => 'form-control'))}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <label>Từ ngày</label>
                </div>
                <div class="col-md-9">
                    <input class="form-control input-sm" type="text" name="from_date" id="datepicker6" value="{{ Input::old('from_date') }}">
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="padding-top: 20px">
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
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <label>Đến ngày</label>
                </div>
                <div class="col-md-9">
                    <input class="form-control input-sm" type="text" name="to_date" id="datepicker5">
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="padding-top: 20px">
        

        @if ($type == 'campaign')
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-3">
                        <label>Mã chiến dịch</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="campaign_code" class="form-control" placeholder="Search"/>
                    </div>
                </div>
            </div>
        @endif
    </div>
    {{-- end --}}
    <div class="row" style="padding-top: 20px">
        <div class="col-md-12" style=" text-align: center;">
            <div class="form-group">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>  Tìm kiếm</button>
            </div>
        </div>
    </div>

    {{ Form::close() }}
</div>
<script type="text/javascript" src="../assets/js/combotree/jquery.easyui.min.js"></script>
