<link rel="stylesheet" type="text/css" href="../assets/js/combotree/themes/metro/easyui.css">
<link rel="stylesheet" type="text/css" href="../assets/js/combotree/themes/icon.css">
<link rel="stylesheet" type="text/css" href="../assets/js/combotree/demo/demo.css">
<div class="margin-bottom margin-top">
    {{ Form::open(array('action' => 'ScaleStationController@getStatistic', 'method' => 'GET', 'id'=>'searchForm')) }}
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
                    <label>Mã chiến dịch</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="campaign_code" class="form-control" placeholder="Search"/>
                </div>
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <label>Kho</label>
                </div>
                <div class="col-md-9">
                    {{ Form::select('warehouse_id', ['' => 'Chọn'] + Warehouse::lists('name', 'id'), null,  array('class' => 'form-control', 'id' => 'department_id'))}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <label>Chi nhánh</label>
                </div>
                <div class="col-md-9">
                    {{ Form::select('department_id', ['' => 'Chọn'] + Company::level(4)->lists('name', 'id'), null,  array('class' => 'form-control', 'id' => 'department_id'))}}
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}
    <div class="row" style="padding-top: 20px">
        <div class="col-md-12" style=" text-align: center;">
            <div class="form-group">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>  Tìm kiếm</button>
            <button type="button" class="btn btn-default" id="clear-search">Xóa bỏ</button>
            </div>
        </div>
    </div>

    {{ Form::close() }}
</div>
<script type="text/javascript" src="../assets/js/combotree/jquery.easyui.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#clear-search').click(function(){
            document.getElementById("searchForm").reset();
            $('.form-group :input').val('');
        });
    });
</script>