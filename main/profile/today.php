<?php
$valve_status="";
$valve_color="";
$dat=date("Y-m-d");
date_default_timezone_set('Asia/Kolkata');
include 'db.php';
$connect = mysqli_connect($servername, $username, $password, $database);
$query = "SELECT sno FROM visits where user_id='$id' and dates='$dat'";
$result = mysqli_query($connect, $query);
?>
<?php echo mysqli_num_rows($result);?>