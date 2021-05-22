
<?php

$dateTime = new DateTime('now');
$monday = clone $dateTime->modify(('Sunday' == $dateTime->format('l')) ? 'Sunday last week' : 'Monday this week');
$sunday = clone $dateTime->modify('Sunday this week');

$sun=$sunday->format('Y-m-d');
$mon=$monday->format('Y-m-d');
$valve_status="";
$valve_color="";
$dat=date("Y-m-d");
date_default_timezone_set('Asia/Kolkata');
include 'db.php';
$connect = mysqli_connect($servername, $username, $password, $database);
$query = "SELECT sno FROM visits where user_id='$id' and dates between '$mon' and '$sun'";
$result = mysqli_query($connect, $query);
?>
<?php echo mysqli_num_rows($result);?>