<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> @yield('title') </title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.5 -->

	{{HTML::style('adminlte/bootstrap/css/bootstrap.min.css') }}
	<!-- Font Awesome -->
	{{HTML::style('adminlte/dist/css/font-awesome.min.css') }}
	<!-- Ionicons -->
	{{HTML::style('adminlte/dist/css/ionicons.min.css') }}
	<!-- Theme style -->
	{{HTML::style('adminlte/dist/css/AdminLTE.min.css') }}
	{{HTML::style('adminlte/dist/css/admin.css') }}
	<!-- AdminLTE Skins. Choose a skin from the css/skins
			 folder instead of downloading all of them to reduce the load. -->
	{{HTML::style('adminlte/dist/css/skins/_all-skins.min.css') }}
    {{ HTML::style('assets/css/select2.css') }}
	<!-- Date Picker -->
	{{-- {{HTML::style('adminlte/plugins/datepicker/datepicker3.css') }} --}}
	<!-- Daterange picker -->
	{{-- {{HTML::style('adminlte/plugins/daterangepicker/daterangepicker-bs3.css') }} --}}
	<!-- bootstrap wysihtml5 - text editor -->
	{{-- {{HTML::style('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }} --}}
	<!-- Date Time Picker -->
	{{HTML::style('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.css') }}

	{{ HTML::style('adminlte/plugins/jQueryUI/jquery-ui.css') }}
    <style type="text/css" media="screen">
        legend {
            display: block;
            width: auto;
            padding: 0;
            margin-bottom: 20px;
            font-size: 21px;
            line-height: inherit;
            color: #333;
            border: 0;
            border-bottom: none;
        }

        fieldset {
            padding: .35em .625em .75em;
            margin: 0 2px;
            border: 1px solid silver;
        }
        .select2-container { padding: 0 !important}
    </style>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- jQuery 2.1.4 -->
	{{ HTML::script('adminlte/plugins/jQuery/jQuery-2.1.4.min.js') }}
	<!-- jQuery UI 1.11.4 -->
	{{ HTML::script('adminlte/plugins/jQueryUI/jquery-ui.min.js') }}
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

	<script>
		$.widget.bridge('uibutton', $.ui.button);
	</script>
	<!-- Bootstrap 3.3.5 -->
	{{ HTML::script('adminlte/bootstrap/js/bootstrap.min.js') }}
	<!-- daterangepicker -->
	{{-- {{ HTML::script('adminlte/plugins/daterangepicker/moment.min.js') }} --}}
	{{-- {{ HTML::script('adminlte/plugins/daterangepicker/daterangepicker.js') }} --}}
	<!-- datepicker -->
	{{-- {{ HTML::script('adminlte/plugins/datepicker/bootstrap-datepicker.js') }} --}}
	<!-- Bootstrap WYSIHTML5 -->
	{{-- {{ HTML::script('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }} --}}
	<!-- datetimepicker -->
	{{ HTML::script('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}
	<!-- FastClick -->
	{{ HTML::script('adminlte/plugins/fastclick/fastclick.js') }}
    {{ HTML::script('assets/js/select2.js') }}
	<!-- AdminLTE App -->
	{{ HTML::script('adminlte/dist/js/app.min.js') }}

	<script>
	  $(function () {
	    $('#start_date').datetimepicker({
	    	format: "yyyy-mm-dd hh:ii:00",
			todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			forceParse: 0,
	    });
	    $('#end_date').datetimepicker({
	    	format: "yyyy-mm-dd hh:ii:00",
			todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			forceParse: 0,
	    });
	    $('#start_update_date').datetimepicker({
	    	format: "yyyy-mm-dd hh:ii:00",
			todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			forceParse: 0,
	    });
	    $('#end_update_date').datetimepicker({
	    	format: "yyyy-mm-dd hh:ii:00",
			todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			forceParse: 0,
	    });

	    $('#datepickerStartdate').datepicker({
	    	dateFormat: 'yy-mm-dd',
			});
	    $('#datepickerEnddate').datepicker({
	    	dateFormat: 'yy-mm-dd',
			});
         $('#datepicker1').datepicker({
            dateFormat: 'yy-mm-dd',
            });
          $('#datepicker2').datepicker({
            dateFormat: 'yy-mm-dd',
            });
           $('#datepicker3').datepicker({
            dateFormat: 'yy-mm-dd',
            });
           $('#datepicker4').datepicker({
            dateFormat: 'yy-mm-dd',
            });
            $('#datepicker5').datepicker({
            dateFormat: 'yy-mm-dd',
            });
            $('#datepicker6').datepicker({
            dateFormat: 'yy-mm-dd',
            });
            $('#date_bonus').datepicker({
            dateFormat: 'yy-mm-dd',
            });
             $('#pay_time').datepicker({
            dateFormat: 'yy-mm-dd',
            });

	  });

      $(document).ready(function(){
        // change menu
        $('#hr-menu').click(function(){
            $('.child-menu').hide();
            $('#child-hr').show();
        });
        $('#salary-menu').click(function(){
            console.log('ffsd');
            $('.child-menu').hide();
            $('#child-salary').show();
        });
        $('#insuance-menu').click(function(){
            $('.child-menu').hide();
            $('#child-insuance').show();
        });
         $('#system-menu').click(function(){
            $('.child-menu').hide();
            $('#child-system').show();
        });
         $('#section_branch_model').change( function($this){
            // var token =  $("input[name=_token]").val();
            // var data = {'branch_category_id':$('#section_branch').val()};
            // $.ajax({
            //     type: "GET",
            {{-- //     url : "{{action('PositionCategoryController@getPositionWithBranch')}}", --}}
            //     data : data,
            //     success : function(data){
            //         var select = '';
            //         // data.foreach(function(item){
            //         //     select = select . '<option value="1">CTO</option>'
            //         // });
            //         for (var key in data) {
            //             var value = data[key];
            //             select = select + '<option value="'+key+'">'+data[key]+'</option>';
            //         }
            //         $('#section_position_model').html(select);
            //         // console.log(select);
            //     }
            // },"json");
        })
     });
	</script>

</head>