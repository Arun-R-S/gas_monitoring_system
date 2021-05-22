<?php
include 'db.php';
$subscriber_id = $_POST['subscriber_id'];
$user_id = $_POST['user_id'];
$up = date('dmyDMYhmss');
$conn = mysqli_connect($servername, $username, $password, $database);
$q1 = "SELECT user_id from notification_onesignal where user_id='$user_id'";
$result = mysqli_query($conn, $q1);
if($result->num_rows==0)
{
	$q2 = "INSERT into notification_onesignal (user_id, subscriber_id, updating) values ('$user_id', '$subscriber_id', '$up')";
	$result = mysqli_query($conn, $q2);
	echo $subscriber_id." ";
	echo $user_id." ";
	echo "User id and subscriber_id is new";
}
else
{
	echo "User id is old ";
	$q3 = "SELECT subscriber_id from notification_onesignal where subscriber_id='$subscriber_id' and user_id='$user_id'";
	$result = mysqli_query($conn, $q3);
	if($result->num_rows==0)
	{
		$q4 = "INSERT into notification_onesignal (user_id, subscriber_id, updating) values ('$user_id', '$subscriber_id', '$up')";
		$result = mysqli_query($conn, $q4);
		echo $subscriber_id." ";
		echo $user_id." ";
		echo "and subscriber_id is new";

	}
	else
	{
		$q4 = "UPDATE notification_onesignal SET updating = '$up' where user_id='$user_id' and subscriber_id='$subscriber_id'";
		$result = mysqli_query($conn, $q4);
		echo "and subscriber_id both are old";
	}
}
?>