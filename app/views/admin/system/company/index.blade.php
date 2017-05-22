@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Cơ cấu tổ chức'}}
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
        <h2>Cơ cấu tổ chức</h2>
        <p>Hệ thống cơ cấu tổ chức nhân sự.</p>
        <div style="margin:20px 0;">
            <a class="easyui-linkbutton" onclick="edit()">Sửa chi nhánh</a>
            <a class="easyui-linkbutton" onclick="remove()" id="btn-delete">Xóa</a>
        </div>
        
        <div class="easyui-panel" style="padding:5px">
            <ul id="tt" class="easyui-tree" data-options="url:'jstree',method:'get',animate:true"></ul>
        </div>
    </div>
    <div class="row">
        
    </div>
<script type="text/javascript" src="../assets/js/combotree/jquery.easyui.min.js"></script>
<script type="text/javascript">
    function edit(){
        var node = $('#tt').tree('getSelected');
        var url      = window.location.href + '/' + node.id + "/edit";
        window.location.href = url;
    }
    function remove(){
        // $('#btn-delete').attr('href', 'abc');
        var node = $('#tt').tree('getSelected');
        console.log("node", node);
        var url      = window.location.href + '/' + node.id ;
        console.log("url", url);
        $.ajax({
            url: url,
            method: 'DELETE',
            success: function($response){
                location.reload();
            },
        });
    }

</script>
@stop
@endif
