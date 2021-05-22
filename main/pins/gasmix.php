<?php
$valve_status="";
$valve_color="";
date_default_timezone_set('Asia/Kolkata');
include '../db.php';
$uid=$_COOKIE['user_id'];
$connect = mysqli_connect($servername, $username, $password, $database);
$query = "SELECT * FROM testing where user_id='$uid' ORDER BY time DESC LIMIT 1";
$result = mysqli_query($connect, $query);
$gasmix_color="";
while($row = mysqli_fetch_array($result))
{
	$gas_mix=$row["percent"];
}

if($gas_mix<30)
{
	$gasmix_color="info";
}
else
{
	$gasmix_color="red";
}
?>
<div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0" >Gas Mixture in air</h5>
                      <span class="h2 font-weight-bold mb-0">
							<?php echo $gas_mix;?>%
                      </span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-<?php echo $gasmix_color;?> text-white rounded-circle shadow">
                        <i class="">%</i>
                      </div>
                    </div>
