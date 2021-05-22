<?php 
//index.php
include 'db.php';
$uid=$_COOKIE['user_id'];
$connect = mysqli_connect($servername, $username, $password, $database);
$query = "SELECT * FROM testing where user_id='$uid' ORDER BY time DESC LIMIT 25";
$result = mysqli_query($connect, $query);
$chart_data1 = '';
$chart_data2 = '';
while($row = mysqli_fetch_array($result))
{
  $chart_data1 .= "{ time:'".$row["time"]."', sensor:".$row["sensor"].", percent:".$row["percent"]."}, ";
  $chart_data2 .= "{ time:'".$row["time"]."', sensor:".$row["sensor"].", percent:".$row["percent"]."}, ";
}

$chart_data2 = substr($chart_data2, 0, -2);
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
if(isMobile()){
    $size=350;
}
else {
    $size=400;
}

?>

    <div class="row">
    	<div class="col-sm">
			   <div class="container" style="width:<?php echo $size;?>;">
   			    <h2 align="center" class="text-white">Percentage of Butane in air</h2>
   				   <div id="percent_chart">
   				   </div>
			   </div>
		  </div>
	 </div>
<script type="text/javascript">

Morris.Area({
 element : 'percent_chart',
 data:[<?php echo $chart_data2; ?>],
 xkey:'time',
 ykeys:['percent'],
 labels:['Percent'],
 hideHover:'auto',
 postUnits:'%',
 pointFillColors: ['red'],
 pointStrokeColors: ['black'],
 lineColors: ['green'],
 fillOpacity: 0.7,

 ymax:100,
  smooth:true,
 stacked:true
});
</script>