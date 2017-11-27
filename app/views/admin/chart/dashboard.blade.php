@extends('admin.layout.default')

@section('title')
{{ $title='Báo cáo thống kế' }}
@stop


@section('content')
@include('admin.scale-station.template.search-scale-odd-js')

<!-- Chart -->
{{ HTML::script('adminlte/plugins/chartjs/Chart.min.js') }}
<?php $color = ['#FF5A5E', '#46BFBD', '#FDB45C', '#00a65a', '#3c8dbc', '#01a758'] ?>
<br>

{{ Form::open(['action' => ['StatisticsChartController@index'], 'method' => 'GET', 'class'=> 'form form-group']) }}
	<div class="input-group" style="display: inline-block; vertical-align: bottom;">
		<label>Chọn sản phẩm</label>
		{{ Form::select('product', ['' => 'Chọn sản phẩm'] + Common::listNameProductAndCategory(), Input::get('product'), ['class' => 'form-control', 'required' => 'true']) }}
	</div>
	<div class="input-group" style="display: inline-block; vertical-align: bottom;">
		<label>Chọn chi nhánh</label>
		{{ Form::select('department_id', ['' => 'Chọn chi nhánh'] + Company::level(4)->lists('name', 'id'), Input::get('department_id'), ['class' => 'form-control', 'id' => 'department_id', 'required' => 'true']) }}
	</div>
	<div class="input-group" style="display: inline-block; vertical-align: bottom;">
		<label>Chọn kho</label>
		<?php $warehouselist = Warehouse::select(['department_id', 'id', 'name'])->get(); ?>
        <select name="warehouse_id" id="warehouse_id" class="form-control">
            <option value="">Chọn tất cả</option>
            @foreach ($warehouselist as $key => $value)
                <option style="display:{{ (Input::get('department_id') != $value->department_id ) ? 'none' : 'block' }}" {{ (Input::get('warehouse_id') == $value->id ) ? 'selected' : '' }} department-id="{{ $value->department_id }}" value="{{ $value->id }}">{{ $value->name }}</option>
            @endforeach
        </select>
	</div>
	<div class="input-group" style="display: inline-block; vertical-align: bottom;">
		<label>Thời gian từ:</label>
		{{ Form::text('start_date', Input::get('start_date'), ['class' => 'form-control', 'id' => 'start_date', 'required' => 'true']) }}
	</div>
	<div class="input-group" style="display: inline-block; vertical-align: bottom;">
		<label>Thời gian đến:</label>
		{{ Form::text('end_date', Input::get('end_date'), ['class' => 'form-control', 'id' => 'end_date']) }}
	</div>
	<div class="input-group" style="display: inline-block; vertical-align: bottom;">
		<button class="btn btn-primary" type="submit">Xem</button>
		{{-- <input type="reset" value="Nhập lại" class="btn btn-info"> --}}
	</div>
{{ Form::close() }}

<div class="clear clearfix"></div>

{{-- <div class="statistic-list">
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
</div> <!-- End statistic-list --> --}}
<?php
$scale_arr = [];
if (isset($scale_rate)) {
	foreach ($scale_rate as $key => $value) {
		if( in_array($value->transfer_type, [2,4]) ){
			///// Nhap kho
			$scale_arr[$value->created]['import'][] = (int)$value->package_weight;
		}
		else{
			// Xuat kho
			$scale_arr[$value->created]['export'][] = (int)$value->package_weight;
		}
	}
}

// dd($scale_arr);
?>

@if( !empty(Input::all()) && count($strorage_loss) )
	<div class="row">
		<div class="col-xs-12 col-sm-8 chart-box">
			<div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title">Biểu đồ nhập/xuất từ {{ date_format(date_create(Input::get('start_date')), 'm-Y') }} đến {{ date_format(date_create(Input::get('end_date')), 'm-Y') }}</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="box-body">
					@if (count($scale_arr))
						<div class="chart bar">
							<div class="unit-y pull-left">Khối lượng(tấn)</div>
							<canvas id="barChart" style="height:230px"></canvas>
							<div class="unit-x text-center">
								<span class="sub"><span class="color" style="background: #d0d8dd"></span>Nhập</span>
								<span class="sub"><span class="color" style="background: #01a758"></span>Xuất</span>
							</div>
						</div>
						<script type="text/javascript">
							//-------------
						    //- BAR CHART -
						    //-------------
						    var barChart = new Chart($("#barChart").get(0).getContext("2d"));
						    var barChartData = {
							    labels: [
							    	@foreach ($scale_arr as $key => $value)
							    		'{{ $key }}',
							    	@endforeach
							    ],
							    datasets: [
							      {
							        label: "Nhập",
							        fillColor: "#ccc",
							        pointStrokeColor: "#c1c7d1",
							        pointHighlightFill: "#fff",
							        pointHighlightStroke: "rgba(220,220,220,1)",
							        data: [
							        	@foreach ($scale_arr as $key => $value)
								    		{{ (isset($value['import'])) ? floor(array_sum($value['import'])/1000) : 0 }},
								    	@endforeach
							        ]
							      },
							      {
							        label: "Xuất",
							        fillColor: "#01a758",
							        pointStrokeColor: "rgba(60,141,188,1)",
							        pointHighlightFill: "#fff",
							        pointHighlightStroke: "rgba(60,141,188,1)",
							        data: [
							        	@foreach ($scale_arr as $key => $value)
								    		{{ (isset($value['export'])) ? floor(array_sum($value['export'])/1000) : 0 }},
								    	@endforeach
							        ]
							      }
							    ]
							};
						    barChart.Bar(barChartData, {
						    	datasetFill: false,
						    	barShowStroke: false,
						    	barValueSpacing: 10,
						    });
						</script>
					@else
						<em>Không có dữ liệu</em>
					@endif
					
				</div><!-- /.box-body -->
			</div>
			<div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title">Biểu đồ nhập/xuất từ {{ date_format(date_create(Input::get('start_date')), 'm-Y') }} đến {{ date_format(date_create(Input::get('end_date')), 'm-Y') }}</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="box-body">
					@if (count($scale_arr))
						<div class="chart line">
							<div class="unit-y pull-left">Khối lượng(tấn)</div>
							<canvas id="lineChart" style="height:230px"></canvas>
						</div>

						<script type="text/javascript">
							//-------------
						    //- LINE CHART -
						    //-------------
						    var lineChart = new Chart($("#lineChart").get(0).getContext("2d"));
						    var lineChartData = {
						    	labels: [
							    	@foreach ($scale_arr as $key => $value)
							    		'{{ $key }}',
							    	@endforeach
							    ],
								datasets: [{
									label: "My First dataset",
									fillColor: "rgba(220,220,220,0.2)",
									strokeColor: "rgba(220,220,220,1)",
									pointColor: "rgba(220,220,220,1)",
									pointStrokeColor: "#fff",
									pointHighlightFill: "#fff",
									pointHighlightStroke: "rgba(220,220,220,1)",
									data: [
							        	@foreach ($scale_arr as $key => $value)
								    		{{ (isset($value['import'])) ? floor(array_sum($value['import'])/1000) : 0 }},
								    	@endforeach
							        ]
								},
								{
									label: "My Second dataset",
									fillColor: "rgba(151,187,205,0.2)",
									strokeColor: "rgba(151,187,205,1)",
									pointColor: "rgba(151,187,205,1)",
									pointStrokeColor: "#fff",
									pointHighlightFill: "#fff",
									pointHighlightStroke: "rgba(151,187,205,1)",
									data: [
							        	@foreach ($scale_arr as $key => $value)
								    		{{ (isset($value['export'])) ? floor(array_sum($value['export'])/1000) : 0 }},
								    	@endforeach
							        ]
								}]
							};
						    lineChart.Line(lineChartData, {});
						</script>
					@else
						<em>Không có dữ liệu</em>
					@endif
				</div><!-- /.box-body -->
			</div>
		</div>

		<div class="col-xs-12 col-sm-4 chart-box">
			<div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title">Kho {{ (!empty(Input::get('product')) && isset(Common::listNameProductAndCategory()[Input::get('product')])) ? Common::listNameProductAndCategory()[Input::get('product')] : 'nguyên liệu/sản phẩm' }} tại các chi nhánh</h3>
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
							@foreach( $strorage_loss as $key => $value )
								@if( (int)$value->weight > 0 )
									<div class="item"><span class="circle" style="border:3px solid {{ (isset($color[$key]) ? $color[$key] : '#F7464A') }}"></span>{{ $value->name }}</div>
								@endif
							@endforeach
						</div>
						<div class="details col-xs-12">
							@foreach( $strorage_loss as $key => $value )
								<div class="item">{{ $value->name }}: {{ $value->weight/1000 }} tấn</div>
							@endforeach
						</div>
					</div>
				</div><!-- /.box-body -->
			</div>
			<script type="text/javascript">
				//-------------
			    //- doughnut CHART -
			    //-------------
			    var doughnutChart = new Chart($("#doughnutChart").get(0).getContext("2d"));
			    var doughnutChartData = [
		    		@foreach( $strorage_loss as $key => $value )
						{
							value: {{ $value->weight/1000 }},
							color:"{{ (isset($color[$key]) ? $color[$key] : '#F7464A') }}",
							highlight: "#FF5A5E",
							label: "{{ $value->name }}"
						},
					@endforeach
				];
			    doughnutChart.Doughnut(doughnutChartData, {});
			</script>
		</div>

		<div class="col-xs-12 col-sm-8 chart-box">

		</div>
	</div> <!-- End row -->

@else
<div class="alert alert-error">Không có dữ liệu.</div>
@endif

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
