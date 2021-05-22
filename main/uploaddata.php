<?php
date_default_timezone_set('Asia/Kolkata');
include 'db.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if(isset($_REQUEST['userid']))
{
	$userid = $_REQUEST['userid'];
	print("User Id : ".$userid.",\n");
}
else
{
    print("userid field is null,\n");
}
$query = "SELECT * FROM user_info WHERE user_id='$userid'";
$result = mysqli_query($conn, $query);
$row=$result->fetch_assoc();
if($row['allowing']=="NO")
{
	echo "Your account is blocked";
	exit();
}


if(isset($_REQUEST['sensor']))
{
    $sensor = $_REQUEST['sensor'];
    //print("Sensor : ".$sensor.",\n");
}
else
{
    print("sensor field is null,\n");
}
if(isset($_REQUEST['percent']))
{
    $percent = $_REQUEST['percent'];
    //print("Percent : ".$percent.",\n");
}
else
{
    print("percent field is null,\n");
}
if(isset($_REQUEST['gasdetect']))
{
    $gasdetect = $_REQUEST['gasdetect'];
    //print("Leakage Detection : ".$gasdetect.",\n");
}
else
{
    print("gasdetect field is null,\n");
}
if(isset($_REQUEST['alarm']))
{
    $alarm = $_REQUEST['alarm'];
    //print("Alarm : ".$alarm.",\n");
}
else
{
    print("alarm field is null,\n");
}
if(isset($_REQUEST['gas_valve']))
{
    $gas_valve = $_REQUEST['gas_valve'];
    //print("Gas Valve : ".$gas_valve.",\n");
}
else
{
    print("gas_valve field is null,\n");
}


//$sql = "INSERT INTO visits (user_id,dates) VALUES ('RSA651518','2021-01-01')";
		//$conn->query($sql);
$sql = "INSERT INTO testing (user_id, sensor, percent, detection, alarm, gas_valve) VALUES ('$userid', '$sensor', '$percent', '$gasdetect', '$alarm', '$gas_valve')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$query2 = "SELECT last_notification FROM user_info where user_id='$userid'";
$result2 = mysqli_query($conn, $query2);
$row2 = mysqli_fetch_array($result2);


$timestamp = strtotime($row2['last_notification']);
$time = date('G:i:s', $timestamp);
$current = date("G:i:s");

$datetime1 = new DateTime($time);//start time
$datetime2 = new DateTime($current);//end time
$interval = $datetime1->diff($datetime2);

$update = date("Y-m-d G:i:s");

//echo " ".$interval->format('%s')." seconds";
if($gasdetect=="YES" and ($interval->format('%s')>20 or $interval->format('%i')>0 or $interval->format('%H')>0 or $interval->format('%d')>0 or $interval->format('%d')>0 or $interval->format('%m')>0 or $interval->format('%Y')>0) )
{
	
    $conn = mysqli_connect($servername, $username, $password, $database);
    $query3 = "UPDATE user_info SET last_notification = '$update' where user_id='$userid'";
    $result = mysqli_query($conn, $query3);

	$ch = curl_init();
	$url = "http://localhost/project/gas_monitoring_system_testing/main/send_many_notification.php?email=".base64_encode($row['email'])."&user_id=".base64_encode($row['user_id']);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_POST, TRUE);
	$response = curl_exec($ch);
	curl_close($ch);
	print($response);
}

?>
