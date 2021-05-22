
<?php
date_default_timezone_set('Asia/Kolkata');
$day = date('w');
$mon = date('Y-m-d', strtotime('-'.$day.' days'));
$sun = date('Y-m-d', strtotime('+'.(6-$day).' days'));

include 'db.php';
$connect = mysqli_connect($servername, $username, $password, $database);
$query = "SELECT sno FROM visits where user_id='$id' and dates between '$mon' and '$sun'";
$result = mysqli_query($connect, $query);
?>
<div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
<i class=""><?php echo mysqli_num_rows($result);?></i>
</div>