@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
@stop
@section('content')
<link rel="stylesheet" type="text/css" href="../assets/js/combotree/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="../assets/js/combotree/themes/icon.css">
<link href="../assets/js/jstree/dist/themes/default/style.min.css" rel="stylesheet" type="text/css" />
    <div class="row margin-bottom">
        <div class="col-xs-12">
            <a href="{{ action('CompanyCategoryController@create') }}" class="btn btn-primary">Thêm mới </a>
        </div>
    </div>
    <div class="row">
        <table id="dg" title="My Users" class="easyui-datagrid" style="width:700px;height:250px"
                url="scale-station/list"
                toolbar="#toolbar" pagination="true"
                rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="name" width="50">Tên</th>
                    <th field="department_id" width="50">Chi nhánh</th>
                </tr>
            </thead>
        </table>
        <div id="toolbar">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">New User</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit User</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Remove User</a>
        </div>
        
        <div id="dlg" class="easyui-dialog" style="width:400px"
                closed="true" buttons="#dlg-buttons">
            <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
                <div style="margin-bottom:20px;font-size:14px;border-bottom:1px solid #ccc">Trạm cân</div>
                <div style="margin-bottom:10px">
                    <input name="name" class="easyui-textbox" required="true" label="Tên:" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                    {{ Form::select('department_id', Company::where('level', 3)->lists('name', 'id'), null,  array('class' => 'easyui-combobox', 'label' => 'Chi nhánh:', 'style' => 'width:100%'))}}
                </div>
            </form>
        </div>
        <div id="dlg-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
        </div>
    </div>
<script type="text/javascript" src="../assets/js/combotree/jquery.easyui.min.js"></script>
<script type="text/javascript">
        var url;
        function newUser(){
            $('#dlg').dialog('open').dialog('center').dialog('setTitle','Thêm mới trạm cân');
            $('#fm').form('clear');
            url = 'scale-station';
        }
        function editUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlg').dialog('open').dialog('center').dialog('setTitle','Sửa trạm cân');
                $('#fm').form('load',row);
                url = 'scale-station/update/'+row.id;
            }
        }
        function saveUser(){
            $('#fm').form('submit',{
                url: url,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    var result = eval('('+result+')');
                    if (result.errorMsg){
                        $.messager.show({
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    } else {
                        $('#dlg').dialog('close');        // close the dialog
                        $('#dg').datagrid('reload');    // reload the user data
                    }
                }
            });
        }
        function destroyUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirm','Are you sure you want to destroy this user?',function(r){
                    if (r){
                        $.post('destroy_user.php',{id:row.id},function(result){
                            if (result.success){
                                $('#dg').datagrid('reload');    // reload the user data
                            } else {
                                $.messager.show({    // show error message
                                    title: 'Error',
                                    msg: result.errorMsg
                                });
                            }
                        },'json');
                    }
                });
            }
        }
    </script>
@stop
@endif
