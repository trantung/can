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
                    <label>Mã phiếu cân</label>
                </div>
                <div class="col-md-9">
                    <input class="form-control input-sm" type="text" name="number_ticket" value="{{ Input::old('number_ticket') }}">
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
                    <label>Kho</label>
                </div>
                <div class="col-md-9">
                    <?php $warehouselist = Warehouse::select(['department_id', 'id', 'name'])->get(); ?>
                    <select name="warehouse_id" id="warehouse_id" class="form-control">
                        <option value="">Chọn tất cả</option>
                        @foreach ($warehouselist as $key => $value)
                            <option style="display:{{ (Input::get('department_id') != $value->department_id ) ? 'none' : 'block' }}" {{ (Input::get('warehouse_id') == $value->id ) ? 'selected' : '' }} department-id="{{ $value->department_id }}" value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                    {{-- {{ Form::select('warehouse_id', ['' => 'Chọn tất cả', ] + Warehouse::lists('name', 'id', 'department_id'), null,  array('class' => 'form-control'))}} --}}
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="padding-top: 20px">
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
                    <label>Loại sản phẩm</label>
                </div>
                <div class="col-md-9">
                    {{ Form::select('category_id', ['' => 'Chọn']+Common::listNameProductAndCategory(), null, array('class' => 'form-control')) }} 
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <label>Nhóm khách hàng</label>
                </div>
                <div class="col-md-9">
                    {{ Form::select('customer_group_id', ['' => 'Chọn']+Common::getCustomerGroup(), null, array('class' => 'form-control')) }} 
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <label>Khách hàng</label>
                </div>
                <div class="col-md-9">
                    <?php 
                    $customerShip = CustomerShip::select(['customer_ships.id as customer_ships_id', 'customer_ships.customer_name as customer_ships_name', 'customer_groups.id as customer_groups_id'])
                        ->join('customer_manage', 'customer_manage.customer_id', '=', 'customer_ships.id')
                        ->join('customer_groups', 'customer_manage.customer_group_id', '=', 'customer_groups.id')
                        ->get();
                    // dd($customerShip->toArray()); ?>
                    <select name="customer_id" id="customer_id" class="form-control">
                        <option value="">Chọn tất cả</option>
                        @foreach ($customerShip as $key => $value)
                            <option style="display:{{ (Input::get('customer_group_id') != $value->customer_groups_id ) ? 'none' : 'block' }}" {{ (Input::get('customer_id') == $value->customer_ships_id ) ? 'selected' : '' }} customer-groups-id="{{ $value->customer_groups_id }}" value="{{ $value->customer_ships_id }}">{{ $value->customer_ships_name }}</option>
                        @endforeach
                    </select>
                    {{-- {{ Form::select('customer_id', ['' => 'Chọn']+Common::getCustomerList(), null, array('class' => 'form-control')) }}  --}}
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="padding-top: 20px">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <a href="{{ action('ScaleStationController@exportExcelOdd') }}" class="btn btn-primary">Xuất excel</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <a href="{{ url('/admin/scale-station/statistic/campaign') }}"><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>Huỷ tìm kiếm</button></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>Tìm kiếm</button>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>
<script type="text/javascript" src="../assets/js/combotree/jquery.easyui.min.js"></script>
