<link rel="stylesheet" type="text/css" href="../assets/js/combotree/themes/metro/easyui.css">
<link rel="stylesheet" type="text/css" href="../assets/js/combotree/themes/icon.css">
<link rel="stylesheet" type="text/css" href="../assets/js/combotree/demo/demo.css">
<div class="margin-bottom margin-top">
    @include('admin.common.structure_company_css')
    {{ Form::open(array('action' => 'WarehouseController@search', 'method' => 'GET', 'id'=>'searchForm')) }}
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <label>Chi nhánh</label>
                </div>
                <div class="col-md-9">
                    <input name="department_id" class="easyui-combotree" data-options="url:'/admin/jstree',method:'get'" style="width:100%">
                </div>
            </div>
        </div>
         <div class="form-group">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>  Tìm kiếm</button>
        </div>
    </div>
    {{ Form::close() }}
    <a href="{{ action('WarehouseController@getCancelSearch') }}" class="btn btn-primary">Huỷ search</a>

</div>
<script type="text/javascript" src="{{ url('/assets/js/combotree/jquery.easyui.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#clear-search').click(function(){
            document.getElementById("searchForm").reset();
            $('.form-group :input').val('');
        });
        
    });
</script>