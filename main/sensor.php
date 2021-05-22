
<?php 
//index.php
include 'db.php';
$uid=$_COOKIE['user_id'];
$connect = mysqli_connect($servername, $username, $password, $database);
$query = "SELECT * FROM testing where user_id='$uid' ORDER BY time DESC LIMIT 25";
$result = mysqli_query($connect, $query);
$chart_data1 = '';
while($row = mysqli_fetch_array($result))
{
  $chart_data1 .= "{ time:'".$row["time"]."', sensor:".$row["sensor"].", percent:".$row["percent"]."}, ";
}
$chart_data1 = substr($chart_data1, 0, -2);

 function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
                     
if(isMobile()){
    $size=350;
}
else {
    $size=500;
}


?>



  <div class="row">
      <div class="col-sm">
      <div class="container" style="width:<?php echo $size;?>;">
          <h2 align="center" class="text-white">Gas Sensor Value</h2>
          <div id="sensor_chart">
          </div>
      </div>
    </div>
  </div>



<script>

Morris.Area({
 element : 'sensor_chart',
 data:[<?php echo $chart_data1; ?>],
 xkey:['time'],
 ykeys:['sensor'],
 labels:['Sensor','Time'],
 hideHover:'auto',
 pointFillColors: ['red'],
 pointStrokeColors: ['black'],
 lineColors: ['blue'],
 fillOpacity: 0.7,
 stacked:true,
 behaveLikeLine: false,
 ymax:750,
 ymin:280,
 resize:true,
 smooth:true,
});


</script>