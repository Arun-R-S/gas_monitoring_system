<?php
$valve_status="";
$valve_color="";
date_default_timezone_set('Asia/Kolkata');
include 'db.php';
$uid=$_COOKIE['user_id'];
$connect = mysqli_connect($servername, $username, $password, $database);
$query = "SELECT * FROM testing where user_id='$uid' ORDER BY time DESC LIMIT 1";
$result = mysqli_query($connect, $query);

while($row = mysqli_fetch_array($result))
{
	$gas_valve=$row["gas_valve"];
}

if($gas_valve=="OFF")
{
	$valve_color="green";
	$valve_status="OFF";
}
else
{
	$valve_status="ON";
	$valve_color="orange";
}
?>
					  <div class="icon icon-shape bg-gradient-<?php echo $valve_color;?> text-white rounded-circle shadow">
                        <i class=""><?php echo $valve_status;?></i>
                      </div>