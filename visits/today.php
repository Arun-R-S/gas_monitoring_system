<?php
$valve_status="";
$valve_color="";
$dat=date("Y-m-d");
include 'db.php';
date_default_timezone_set('Asia/Kolkata');
$connect = mysqli_connect($servername, $username, $password, $database);
$query = "SELECT sno FROM visits where user_id='$id' and dates='$dat'";
$result = mysqli_query($connect, $query);
?>
					  <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class=""><?php echo mysqli_num_rows($result);?></i>
                      </div>