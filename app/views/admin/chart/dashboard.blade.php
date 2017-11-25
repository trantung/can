@extends('admin.layout.default')

@section('title')
{{ $title='Báo cáo thống kế' }}
@stop

@section('content')

<div class="clearfix" style="margin: 15px 0">
	<select class="js-example-basic-single">
		<option value="">Chọn sản phẩm</option>
		<option value="/tét">Sản phẩm 1</option>
		<option value="/tét">Sản phẩm 2</option>
		<option value="/tét">Sản phẩm 3</option>
		<option value="/tét">Sản phẩm 4</option>
		<option value="/tét">Sản phẩm 5</option>
	</select>
	<button class="btn btn-primary" href="#">Xem</button>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".js-example-basic-single").select2();
		});
	</script>
</div> <!-- End select product -->

<div class="statistic-list">
	<div class="row">
		<div class="col-xs-12 col-sm-3">
			<div class="item col-1">
				<div class="box-content">
					<h2 class="title">Nhập dăm hôm nay</h2>
					<span class="sub"><span>150</span> tấn</span>
				</div>
				<a href="#" class="link text-center">Xem chi tiết</a>
			</div>
		</div>

		<div class="col-xs-12 col-sm-3">
			<div class="item col-2">
				<div class="box-content">
					<h2 class="title">Sản xuất dăm tháng 1/2017</h2>
					<span class="sub"><span>150</span> tấn</span>
				</div>
				<a href="#" class="link text-center">Xem chi tiết</a>
			</div>
		</div>
		<div class="col-xs-12 col-sm-3">
			<div class="item col-3">
				<div class="box-content">
					<h2 class="title">Sản xuất dăm tháng 2/2017</h2>
					<span class="sub"><span>150</span> tấn</span>
				</div>
				<a href="#" class="link text-center">Xem chi tiết</a>
			</div>
		</div>
		<div class="col-xs-12 col-sm-3">
			<div class="item col-4">
				<div class="box-content">
					<h2 class="title">Sản xuất dăm tháng 3/2017</h2>
					<span class="sub"><span>150</span> tấn</span>
				</div>
				<a href="#" class="link text-center">Xem chi tiết</a>
			</div>
		</div>
	</div> <!-- End row -->
</div> <!-- End statistic-list -->

<div class="row">
	<div class="col-xs-12 col-sm-8 chart-box">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Biểu đồ nhập/xuất năm 2017</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div class="box-body">
				<div class="chart bar">
					<div class="unit-y pull-left">Khối lượng(tấn)</div>
					<canvas id="barChart" style="height:230px"></canvas>
					<div class="unit-x text-center">
						<span class="sub"><span class="color" style="background: #d0d8dd"></span>Nhập</span>
						<span class="sub"><span class="color" style="background: #01a758"></span>Xuất</span>
					</div>
				</div>
			</div><!-- /.box-body -->
		</div>
	</div>

	<div class="col-xs-12 col-sm-4 chart-box">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Kho dăm tại các chi nhánh</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div class="box-body">
				<div class="chart doughnut">
					<div class="col-xs-12 col-sm-7">
						<canvas id="doughnutChart" style="height:220px" class="pull-left"></canvas>
					</div>
					<div class="col-xs-12 col-sm-5 description">
						<div class="item"><span class="circle" style="border:3px solid #F7464A"></span>Thái Nguyên</div>
						<div class="item"><span class="circle" style="border:3px solid #46BFBD"></span>Hạ Long</div>
						<div class="item"><span class="circle" style="border:3px solid #FDB45C"></span>Bố Hạ</div>
					</div>
					<div class="details col-xs-12">
						<div class="item">Thái Nguyên: 100 tấn</div>
						<div class="item">Hạ Long: 50 tấn</div>
						<div class="item">Bố Hạ: 100 tấn</div>
					</div>
				</div>
			</div><!-- /.box-body -->
		</div>
	</div>

	<div class="col-xs-12 col-sm-8 chart-box">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Biểu đồ nhập/xuất năm 2017</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div class="box-body">
				<div class="chart line">
					<div class="unit-y pull-left">Khối lượng(tấn)</div>
					<canvas id="lineChart" style="height:230px"></canvas>
				</div>
			</div><!-- /.box-body -->
		</div>
	</div>
</div> <!-- End row -->

<!-- Chart -->
{{ HTML::script('adminlte/plugins/chartjs/Chart.min.js') }}
<script type="text/javascript">
$(function () {
	//-------------
    //- BAR CHART -
    //-------------
    var barChart = new Chart($("#barChart").get(0).getContext("2d"));
    var barChartData = {
	    labels: ["1/2017", "2/2017", "3/2017", "4/2017", "5/2017", "6/2017", "7/2017"],
	    datasets: [
	      {
	        label: "Nhập",
	        fillColor: "#ccc",
	        pointStrokeColor: "#c1c7d1",
	        pointHighlightFill: "#fff",
	        pointHighlightStroke: "rgba(220,220,220,1)",
	        data: [65, 59, 80, 81, 56, 55, 40]
	      },
	      {
	        label: "Xuất",
	        fillColor: "#01a758",
	        pointStrokeColor: "rgba(60,141,188,1)",
	        pointHighlightFill: "#fff",
	        pointHighlightStroke: "rgba(60,141,188,1)",
	        data: [28, 48, 40, 19, 86, 27, 90]
	      }
	    ]
	};
    barChart.Bar(barChartData, {
    	datasetFill: false,
    	barShowStroke: false,
    	barValueSpacing: 10,
    });

	//-------------
    //- doughnut CHART -
    //-------------
    var doughnutChart = new Chart($("#doughnutChart").get(0).getContext("2d"));
    var doughnutChartData = [
		{
			value: 300,
			color:"#F7464A",
			highlight: "#FF5A5E",
			label: "Thái Nguyên"
		},
		{
			value: 50,
			color: "#46BFBD",
			highlight: "#5AD3D1",
			label: "Hạ Long"
		},
		{
			value: 100,
			color: "#FDB45C",
			highlight: "#FFC870",
			label: "Bố Hạ"
		}
	];
    doughnutChart.Doughnut(doughnutChartData, {});

	//-------------
    //- LINE CHART -
    //-------------
    var lineChart = new Chart($("#lineChart").get(0).getContext("2d"));
    var lineChartData = {
    	labels: ["1/2017", "2/2017", "3/2017", "4/2017", "5/2017", "6/2017", "7/2017"],
		datasets: [{
			label: "My First dataset",
			fillColor: "rgba(220,220,220,0.2)",
			strokeColor: "rgba(220,220,220,1)",
			pointColor: "rgba(220,220,220,1)",
			pointStrokeColor: "#fff",
			pointHighlightFill: "#fff",
			pointHighlightStroke: "rgba(220,220,220,1)",
			data: [65, 59, 80, 81, 56, 55, 40]
		},
		{
			label: "My Second dataset",
			fillColor: "rgba(151,187,205,0.2)",
			strokeColor: "rgba(151,187,205,1)",
			pointColor: "rgba(151,187,205,1)",
			pointStrokeColor: "#fff",
			pointHighlightFill: "#fff",
			pointHighlightStroke: "rgba(151,187,205,1)",
			data: [28, 48, 40, 19, 86, 27, 90]
		}]
	};
    lineChart.Line(lineChartData, {});

});
</script>

<style type="text/css">
.statistic-list .item{
	border: 2px solid #666;
    color: #fff;
    background: #2b78e4;
    margin-bottom: 30px;
    line-height: 25px;
    font-size: 15px;
}
.statistic-list .item.col-2{
	background: #009e0f;
}
.statistic-list .item.col-3{
	background: #ff9900;
}
.statistic-list .item.col-4{
	background: #e03a37;
}
.statistic-list .item h2.title{
	margin: 0 0 5px;
    line-height: 30px;
    font-size: 16px;
    font-weight: 600;
}
.statistic-list .item .box-content{
    padding: 10px 15px;
}
.statistic-list .item .sub>span{
	font-size: 22px;
    font-weight: 600;
    padding: 10px 5px 0;
}
.statistic-list .item a.link{
	background: #94bbf1;
	color: #fff;
	padding: 5px 15px;
	width: 100%;
	display: inline-block;
	border-top: 2px solid #666;
}
.statistic-list .item.col-2 a.link{
	background: #7fce86;
}
.statistic-list .item.col-3 a.link{
	background: #ffcc7f;
}
.statistic-list .item.col-4 a.link{
	background: #e79492;
}

/******* CHART ********/
.chart-box .chart.bar .unit-x .sub{
	display: inline-block;
	line-height: 30px;
	margin: 15px 30px;
}
.chart-box .chart.bar .unit-x .sub .color{
	border: 1px solid #666;
	width: 30px;
	height: 30px;
	display: inline-block;
	float: left;
	margin-right: 10px;
}
.chart-box .chart .unit-y{
	margin: 10px 0;
    font-weight: 600;
}

.chart-box .chart.doughnut{
	font-weight: 600;
    line-height: 30px;
}
.chart-box .chart.doughnut .description .item{
    line-height: 30px;
    font-weight: 600;
    margin-bottom: 10px;
}
.chart-box .chart.doughnut .description .item .circle{
	height: 30px;
    width: 30px;
    display: inline-block;
    float: left;
    margin-right: 5px;
    border-radius: 100%;
}
.chart-box .chart.doughnut .details{
	margin-top: 25px;
}
</style>
@stop
