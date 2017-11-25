@extends('admin.layout.default')

@section('title')
{{ $title='Dashboard' }}
@stop

@section('content')
{{ HTML::script('adminlte/plugins/chartjs/Chart.min.js') }}
<script type="text/javascript">
$(function () {
		//-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    var barChart = new Chart(barChartCanvas);
    var barChartData = {
	    labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7"],
	    datasets: [
	      {
	        label: "Electronics",
	        fillColor: "rgba(210, 214, 222, 1)",
	        strokeColor: "rgba(210, 214, 222, 1)",
	        pointColor: "rgba(210, 214, 222, 1)",
	        pointStrokeColor: "#c1c7d1",
	        pointHighlightFill: "#fff",
	        pointHighlightStroke: "rgba(220,220,220,1)",
	        data: [65, 59, 80, 81, 56, 55, 40]
	      },
	      {
	        label: "Digital Goods",
	        fillColor: "rgba(60,141,188,0.9)",
	        strokeColor: "rgba(60,141,188,0.8)",
	        pointColor: "#3b8bba",
	        pointStrokeColor: "rgba(60,141,188,1)",
	        pointHighlightFill: "#fff",
	        pointHighlightStroke: "rgba(60,141,188,1)",
	        data: [28, 48, 40, 19, 86, 27, 90]
	      }
	    ]
	  };

    var barChartOptions = {
      // Boolean - Whether to animate the chart
			animation: true,

			// Number - Number of animation steps
			animationSteps: 60,

			// String - Animation easing effect
			// Possible effects are:
			// [easeInOutQuart, linear, easeOutBounce, easeInBack, easeInOutQuad,
			//  easeOutQuart, easeOutQuad, easeInOutBounce, easeOutSine, easeInOutCubic,
			//  easeInExpo, easeInOutBack, easeInCirc, easeInOutElastic, easeOutBack,
			//  easeInQuad, easeInOutExpo, easeInQuart, easeOutQuint, easeInOutCirc,
			//  easeInSine, easeOutExpo, easeOutCirc, easeOutCubic, easeInQuint,
			//  easeInElastic, easeInOutSine, easeInOutQuint, easeInBounce,
			//  easeOutElastic, easeInCubic]
			animationEasing: "easeOutQuart",

			// Boolean - If we should show the scale at all
			showScale: true,

			// Boolean - If we want to override with a hard coded scale
			scaleOverride: false,

			// ** Required if scaleOverride is true **
			// Number - The number of steps in a hard coded scale
			scaleSteps: null,
			// Number - The value jump in the hard coded scale
			scaleStepWidth: null,
			// Number - The scale starting value
			scaleStartValue: null,

			// String - Colour of the scale line
			scaleLineColor: "rgba(0,0,0,.1)",

			// Number - Pixel width of the scale line
			scaleLineWidth: 1,

			// Boolean - Whether to show labels on the scale
			scaleShowLabels: true,

			// Interpolated JS string - can access value
			scaleLabel: "<%=value%>",

			// Boolean - Whether the scale should stick to integers, not floats even if drawing space is there
			scaleIntegersOnly: true,

			// Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
			scaleBeginAtZero: false,

			// String - Scale label font declaration for the scale label
			scaleFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

			// Number - Scale label font size in pixels
			scaleFontSize: 12,

			// String - Scale label font weight style
			scaleFontStyle: "normal",

			// String - Scale label font colour
			scaleFontColor: "#666",

			// Boolean - whether or not the chart should be responsive and resize when the browser does.
			responsive: true,

			// Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
			maintainAspectRatio: true,

			// Boolean - Determines whether to draw tooltips on the canvas or not
			showTooltips: true,

			// Function - Determines whether to execute the customTooltips function instead of drawing the built in tooltips (See [Advanced - External Tooltips](#advanced-usage-external-tooltips))
			customTooltips: false,

			// Array - Array of string names to attach tooltip events
			tooltipEvents: ["mousemove", "touchstart", "touchmove"],

			// String - Tooltip background colour
			tooltipFillColor: "rgba(0,0,0,0.8)",

			// String - Tooltip label font declaration for the scale label
			tooltipFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

			// Number - Tooltip label font size in pixels
			tooltipFontSize: 14,

			// String - Tooltip font weight style
			tooltipFontStyle: "normal",

			// String - Tooltip label font colour
			tooltipFontColor: "#fff",

			// String - Tooltip title font declaration for the scale label
			tooltipTitleFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

			// Number - Tooltip title font size in pixels
			tooltipTitleFontSize: 14,

			// String - Tooltip title font weight style
			tooltipTitleFontStyle: "bold",

			// String - Tooltip title font colour
			tooltipTitleFontColor: "#fff",

			// String - Tooltip title template
			tooltipTitleTemplate: "<%= label%>",

			// Number - pixel width of padding around tooltip text
			tooltipYPadding: 15,

			// Number - pixel width of padding around tooltip text
			tooltipXPadding: 15,

			// Number - Size of the caret on the tooltip
			tooltipCaretSize: 8,

			// Number - Pixel radius of the tooltip border
			tooltipCornerRadius: 6,

			// Number - Pixel offset from point x to tooltip edge
			tooltipXOffset: 10,

			// String - Template string for single tooltips
			tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
			// String - Template string for multiple tooltips
			multiTooltipTemplate: "<%= value %>",

			// Function - Will fire on animation progression.
			onAnimationProgress: function(){},

			// Function - Will fire on animation completion.
			onAnimationComplete: function(){}

    };

    barChartOptions.datasetFill = false;
    barChart.Bar(barChartData, barChartOptions);
});
</script>


<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Bar Chart</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="chart">
      <canvas id="barChart" style="height:230px"></canvas>
    </div>
  </div>
  <!-- /.box-body -->
</div>
@stop
