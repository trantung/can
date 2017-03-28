@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Cơ cấu tổ chức'}}
@stop

@section('content')
<link rel="stylesheet" type="text/css" href="../assets/js/combotree/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="../assets/js/combotree/themes/icon.css">
<link rel="stylesheet" type="text/css" href="../assets/js/combotree/demo/demo.css">
<link href="../assets/js/jstree/dist/themes/default/style.min.css" rel="stylesheet" type="text/css" />
    <div class="row margin-bottom">
        <div class="col-xs-12">
            <a href="{{ action('CompanyCategoryController@create') }}" class="btn btn-primary">Thêm mới </a>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Cơ cấu tổ chức</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div id="tree_2" class="tree-demo"> </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>
    <div class="row">
        <h2>Cơ cấu tổ chức</h2>
        <p>Hệ thống cơ cấu tổ chức nhân sự.</p>
        <div style="margin:20px 0;">
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="edit()">Sửa</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="save()">Lưu</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="cancel()">Hủy</a>
        </div>
        <table id="tg" class="easyui-treegrid" title="Cơ cấu tổ chức" style="width:700px;height:250px"
                data-options="
                    iconCls: 'icon-ok',
                    rownumbers: true,
                    animate: true,
                    collapsible: true,
                    fitColumns: true,
                    url: 'combotree',
                    method: 'get',
                    idField: 'id',
                    treeField: 'name',
                ">
            <thead>
                <tr>
                    <th data-options="field:'name',width:180,editor:'text'">Tên</th>
                    <th data-options="field:'code',width:60,align:'right',editor:'text'">Mã</th>
                    <th data-options="field:'level',width:80,editor:'text'">Level</th>
                    <th data-options="field:'parent_id',
                        width:80,
                        editor:{
                            type:'combobox',
                            options:{
                                valueField:'id',
                                textField:'name',
                                url:'list-department',
                                onLoadSuccess:function(rows){
                                    for(var i=0; i<rows.length; i++){
                                        var row = rows[i];
                                        if (row.selected){
                                            $(this).combobox('setValue', row.id);
                                            return;
                                        }
                                    }
                                }
                            }
                        }">
                    </th>
                    <th data-options="field:'description',width:80,editor:'text'">Địa chỉ</th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="row">
        <a href="#" class="easyui-linkbutton" onclick="getSelected()">Sửa</a>
        <div class="easyui-panel" style="padding:5px">
            <ul id="tt" class="easyui-tree" data-options="url:'jstree',method:'get',animate:true"></ul>
        </div>
    </div>
<script type="text/javascript" src="../assets/js/combotree/jquery.easyui.min.js"></script>
<script src="../assets/js/jstree/dist/jstree.min.js" type="text/javascript"></script>
<script src="../assets/js/jstree/dist/jstree.action.js" type="text/javascript"></script>
<script type="text/javascript">
    var jstree = $("#tree_2").jstree({
        "ui": {
            "select_limit":1,
        },
        "plugins": ["themes", "html_data", "ui", "crrm", "checkbox"],
        'core': {
            "themes" : {
                "responsive": false
            },    
            'data' : {
                'url' : 'jstree',
            }
        }
    });
    jstree.on('hover_node.jstree',function(e,data){
        var nodeId = data.node.id;
        var link = 'company/' + nodeId + '/edit';
        $("#"+data.node.id).append('<any class="custom"><a href="' + link + '">Sửa</a> <a href="http://google.com">Xóa</a></any>');
    })
    jstree.on('dehover_node.jstree',function(e, data){
        $('#' + data.node.id + ' > any').remove();
    });

    jstree.bind("before.jstree", function (e, data) {
        if(data.func === "check_node") {
            if (j1.jstree('get_checked').length >= 1) {
                e.preventDefault();
                return false;                
            }
        }
    }); 
</script>
<script type="text/javascript">
    var editingId;
    function edit(){
        if (editingId != undefined){
            $('#tg').treegrid('select', editingId);
            return;
        }
        var row = $('#tg').treegrid('getSelected');
        if (row){
            editingId = row.id
            $('#tg').treegrid('beginEdit', editingId);
        }
    }
    function save(){
        if (editingId != undefined){
            var t = $('#tg');
            t.treegrid('endEdit', editingId);
            console.log("editingId", t.treegrid('onAfterEdit'));
            editingId = undefined;
        }
    }
    function cancel(){
        if (editingId != undefined){
            $('#tg').treegrid('cancelEdit', editingId);
            editingId = undefined;
        }
    }
    function getSelected(){
        var node = $('#tt').tree('getSelected');
        if (node){
            console.log("node", node);
            var s = node.text;
            if (node.attributes){
                s += ","+node.attributes.p1+","+node.attributes.p2;
            }
            alert(s);
        }
    }
</script>
@stop
@endif
