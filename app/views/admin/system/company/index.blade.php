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
        <h2>Editable TreeGrid</h2>
        <p>Select one node and click edit button to perform editing.</p>
        <div style="margin:20px 0;">
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="edit()">Edit</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="save()">Save</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="cancel()">Cancel</a>
        </div>
        <table id="tg" class="easyui-treegrid" title="Editable TreeGrid" style="width:700px;height:250px"
                data-options="
                    iconCls: 'icon-ok',
                    rownumbers: true,
                    animate: true,
                    collapsible: true,
                    fitColumns: true,
                    url: 'test',
                    method: 'get',
                    idField: 'id',
                    treeField: 'name',
                    showFooter: true
                ">
            <thead>
                <tr>
                    <th data-options="field:'text',width:180,editor:'text'">Task Name</th>
                    <th data-options="field:'persons',width:60,align:'right',editor:'numberbox'">Persons</th>
                    <th data-options="field:'begin',width:80,editor:'datebox'">Begin Date</th>
                    <th data-options="field:'end',width:80,editor:'datebox'">End Date</th>
                </tr>
            </thead>
        </table>
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
                'url' : 'test',
            }
        }
    });


    jstree.on('select_node.jstree',function(e,data){
        console.log("e", e);
        console.log("data", data);
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
                editingId = undefined;
                var persons = 0;
                var rows = t.treegrid('getChildren');
                for(var i=0; i<rows.length; i++){
                    var p = parseInt(rows[i].persons);
                    if (!isNaN(p)){
                        persons += p;
                    }
                }
                var frow = t.treegrid('getFooterRows')[0];
                frow.persons = persons;
                t.treegrid('reloadFooter');
            }
        }
        function cancel(){
            if (editingId != undefined){
                $('#tg').treegrid('cancelEdit', editingId);
                editingId = undefined;
            }
        }
    </script>
@stop
@endif
