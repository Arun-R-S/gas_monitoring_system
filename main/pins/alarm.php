<?php
$alarm_status="";
$alarm_color="";
date_default_timezone_set('Asia/Kolkata');
include '../db.php';
$uid=$_COOKIE['user_id'];
$connect = mysqli_connect($servername, $username, $password, $database);
$query = "SELECT * FROM testing where user_id='$uid' ORDER BY time DESC LIMIT 1";
$result = mysqli_query($connect, $query);

while($row = mysqli_fetch_array($result))
{
	$gas_alarm=$row["alarm"];
}

if($gas_alarm==0)
{
	$alarm_color="green";
	$alarm_status="OFF";
}
else
{
	$alarm_status="ON";
	$alarm_color="red";
}
?>
<div class="icon icon-shape bg-gradient-<?php echo $alarm_color;?> text-white rounded-circle shadow">
                        <i class=""><?php echo $alarm_status;?></i>
                      </div>