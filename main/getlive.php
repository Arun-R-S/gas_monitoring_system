<?php
date_default_timezone_set('Asia/Kolkata');
include 'db.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$uid=$_COOKIE['user_id'];
$query = "SELECT * FROM user_info WHERE user_id='$uid'";
$result = mysqli_query($conn, $query);
$row=$result->fetch_assoc();

if($row['allowing']=="NO")
{
	echo "Your account is blocked";
	exit();
}

$sensor = rand(280,750);
$percent = (($sensor-280)/470)*100;
$percent = round($percent);
echo $sensor." ";
echo $percent." ";

echo $uid;
//$sql = "INSERT INTO visits (user_id,dates) VALUES ('$uid','2021-01-01')";
//		$conn->query($sql);
$sql = "INSERT INTO testing (user_id, sensor, percent, gas_valve, alarm, detection)
VALUES ('$uid', '$sensor', '$percent', )";


if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


?>

