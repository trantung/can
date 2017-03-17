@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Cơ cấu tổ chức'}}
@stop

@section('content')
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
                <div class="col-xs-10"  style="padding-left:30px;"><b>Tên</b></div>
                <div class="col-xs-2" style="text-align: right">
                <b>Action</b>

                </div>
            </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div id="tree_2" class="tree-demo"> </div>
        </div>
    </div>
<script src="../assets/js/jstree/dist/jstree.min.js" type="text/javascript"></script>
<script type="text/javascript">
    
    $('#tree_2').jstree({
        'core': {
            "themes" : {
                "responsive": false
            },    
            'data' : {
                'url' : 'test',
            }
        }
    });
</script>
@stop
@endif
