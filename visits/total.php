<?php
$valve_status="";
$valve_color="";

date_default_timezone_set('Asia/Kolkata');
include 'db.php';
$connect = mysqli_connect($servername, $username, $password, $database);
$query = "SELECT * FROM visits where user_id='$id'";
$result = mysqli_query($connect, $query);
?>
<div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
<i class=""><?php echo mysqli_num_rows($result);?></i>
</div>