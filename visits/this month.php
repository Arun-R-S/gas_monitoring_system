
<?php

$query_date = date("Y-m-d");;
$start = date('Y-m-01', strtotime($query_date));
$end =  date('Y-m-t', strtotime($query_date));

date_default_timezone_set('Asia/Kolkata');
include 'db.php';
$connect = mysqli_connect($servername, $username, $password, $database);
$query = "SELECT sno FROM visits where user_id='$id' and dates between '$start' and '$end'";
$result = mysqli_query($connect, $query);
?>
<div class="icon icon-shape bg-gradient-blue text-white rounded-circle shadow">
<i class=""><?php echo mysqli_num_rows($result);?></i>
</div>