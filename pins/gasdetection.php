<?php 
$detector_status="";
$detector_color="";
date_default_timezone_set('Asia/Kolkata');
include 'db.php';
$uid=$_COOKIE['user_id'];
$connect = mysqli_connect($servername, $username, $password, $database);
$query = "SELECT * FROM testing where user_id='$uid' ORDER BY time DESC LIMIT 1";
$result = mysqli_query($connect, $query);

while($row = mysqli_fetch_array($result))
{
	$gas_detector=$row["detection"];
}

if($gas_detector=="YES")
{
	$detector_color="red";
	$detector_status="YES";
}
else
{
	$detector_status="NO";
	$detector_color="green";
}
?>
<div class="icon icon-shape bg-gradient-<?php echo $detector_color;?> text-white rounded-circle shadow">
                        <i class=""><?php echo $detector_status;?></i>
                      </div>