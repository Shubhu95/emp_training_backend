<?php


   // +++++++++++++++ start of code to avoid error of call to undefined function cal_days_in_month ++++++++++++++  

    
    if (!function_exists('cal_days_in_month'))
    {
        function cal_days_in_month($calendar, $month, $year)
        { 
            return date('t', mktime(0, 0, 0, $month, 1, $year));
        }
    }
    
    if (!defined('CAL_GREGORIAN'))
    {
        define('CAL_GREGORIAN', 1);
    }
    
    
    // +++++++++++++++ end of code to avoid error of call to undefined function cal_days_in_month ++++++++++++++  
    
    


     $months = array('january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december');
     $month_wise_income = array();

    for ($i = 0; $i < 12; $i++) {
        $first_day_of_month = "1 ".ucfirst($months[$i])." ".date("Y").' 00:00:00';
        $last_day_of_month = cal_days_in_month(CAL_GREGORIAN, $i+1, date("Y"))." ".ucfirst($months[$i])." ".date("Y").' 00:00:00';
        $this->db->select_sum('admin_revenue');
        $this->db->where('date_added >=' , strtotime($first_day_of_month));
        $this->db->where('date_added <=' , strtotime($last_day_of_month));
        $total_admin_revenue = $this->db->get('payment')->row()->admin_revenue;
        $total_admin_revenue > 0 ? array_push($month_wise_income, currency($total_admin_revenue)) : array_push($month_wise_income, 0);
    }

    $status_wise_courses = $this->crud_model->get_status_wise_courses();
    $number_of_active_course = $status_wise_courses['active']->num_rows();
    $number_of_pending_course = $status_wise_courses['pending']->num_rows();
?>

 <!-- Chart code -->
 <script>
 am4core.ready(function() {
     
 var chartdiv_exists = document.getElementById("chartdiv");

 if(chartdiv_exists){

 // Themes begin
 am4core.useTheme(am4themes_animated);
 // Themes end

 var chart = am4core.create("chartdiv", am4charts.XYChart);

 var data = [];

 chart.data = [
     <?php for ($i = 0; $i < 12; $i++): ?>
     {
         "month" : "<?php echo ucfirst($months[$i]); ?>",
         "income": "<?php echo $month_wise_income[$i]; ?>",
         "lineColor": chart.colors.next()
     },
     <?php endfor; ?>
 ];
 var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
 categoryAxis.renderer.grid.template.location = 0;
 categoryAxis.renderer.ticks.template.disabled = true;
 categoryAxis.renderer.line.opacity = 0;
 categoryAxis.renderer.grid.template.disabled = true;
 categoryAxis.renderer.minGridDistance = 40;
 categoryAxis.dataFields.category = "month";
 categoryAxis.startLocation = 0.4;
 categoryAxis.endLocation = 0.6;


 var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
 valueAxis.tooltip.disabled = true;
 valueAxis.renderer.line.opacity = 0;
 valueAxis.renderer.ticks.template.disabled = true;
 valueAxis.min = 0;

 var lineSeries = chart.series.push(new am4charts.LineSeries());
 lineSeries.dataFields.categoryX = "month";
 lineSeries.dataFields.valueY = "income";
 lineSeries.tooltipText = "income: {valueY.value}";
 lineSeries.fillOpacity = 0.5;
 lineSeries.strokeWidth = 3;
 lineSeries.propertyFields.stroke = "lineColor";
 lineSeries.propertyFields.fill = "lineColor";

 var bullet = lineSeries.bullets.push(new am4charts.CircleBullet());
 bullet.circle.radius = 6;
 bullet.circle.fill = am4core.color("#fff");
 bullet.circle.strokeWidth = 3;

 chart.cursor = new am4charts.XYCursor();
 chart.cursor.behavior = "panX";
 chart.cursor.lineX.opacity = 0;
 chart.cursor.lineY.opacity = 0;

 //chart.scrollbarX = new am4core.Scrollbar();
 chart.scrollbarX.parent = chart.bottomAxesContainer;
 
 }

 }); // end am4core.ready()
 </script>

 <!-- Chart code -->
<script>
am4core.ready(function() {

var pieChartdiv_exists = document.getElementById("pieChartdiv");

if(pieChartdiv_exists){

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart
var chart = am4core.create("pieChartdiv", am4charts.PieChart);
// Set data
var selected;
var types = [{
  type: "<?php echo get_phrase('active'); ?>",
  percent: "<?php echo $number_of_active_course; ?>",
  color: chart.colors.getIndex(0)
},
{
  type: "<?php echo get_phrase('pending'); ?>",
  percent: "<?php echo $number_of_pending_course; ?>",
  color: chart.colors.getIndex(1)
}];

// Add data
chart.data = generateChartData();

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "percent";
pieSeries.dataFields.category = "type";
pieSeries.slices.template.propertyFields.fill = "color";
pieSeries.slices.template.propertyFields.isActive = "pulled";
pieSeries.slices.template.strokeWidth = 0;

function generateChartData() {
  var chartData = [];
  for (var i = 0; i < types.length; i++) {
    if (i == selected) {
      for (var x = 0; x < types[i].subs.length; x++) {
        chartData.push({
          type: types[i].subs[x].type,
          percent: types[i].subs[x].percent,
          color: types[i].color,
          pulled: true
        });
      }
    } else {
      chartData.push({
        type: types[i].type,
        percent: types[i].percent,
        color: types[i].color,
        id: i
      });
    }
  }
  return chartData;
}

pieSeries.slices.template.events.on("hit", function(event) {
  if (event.target.dataItem.dataContext.id != undefined) {
    selected = event.target.dataItem.dataContext.id;
  } else {
    selected = undefined;
  }
  chart.data = generateChartData();
});

}


}); // end am4core.ready()
</script>
