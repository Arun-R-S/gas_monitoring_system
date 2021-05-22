<?php
$color="";
$status="";
include 'db.php';
$connect = mysqli_connect($servername, $username, $password, $database);
$uid = $_COOKIE['user_id'];
$query = "SELECT * FROM testing where user_id='$uid' ORDER BY time DESC LIMIT 1";
$result = mysqli_query($connect, $query);

while($row = mysqli_fetch_array($result))
{
	$dates=$row["time"];
}
date_default_timezone_set('Asia/Kolkata');
$timestamp = strtotime($dates);
$time = date('G:i:s', $timestamp);
$current = date("G:i:s");

$datetime1 = new DateTime($time);//start time
$datetime2 = new DateTime($current);//end time
$interval = $datetime1->diff($datetime2);
$differnce = $interval->format('%s');
if($differnce<6 and $interval->format('%i')==0 and $interval->format('%H')==0 and $interval->format('%d')==0 and $interval->format('%d')==0 and $interval->format('%m')==0 and $interval->format('%Y')==0)
{
	$status="Online - Monitoring";
	$color="success";
	echo '<style type="text/css">
        #valve {
            opacity:1;
        }
        </style>';
}
else
{
	$status="Offline - High Risk";
	$color="danger";
	echo '<style type="text/css">
        #valve {
            opacity:0.5;
        }
        </style>';
}
?>
<i class="bg-<?php echo $color;?>"></i>
<span class="status"><?php echo $status;?></span>
                      