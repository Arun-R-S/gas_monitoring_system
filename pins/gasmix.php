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
	$gas_mix=$row["percent"];
}

?>
<span class="h2 font-weight-bold mb-0"><?php echo $gas_mix;?>%</span>