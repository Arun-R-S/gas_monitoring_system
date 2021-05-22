<?php
$ch = curl_init();
$url = "http://localhost/project/gas_monitoring_system_testing/main/send_many_notification.php?email=".base64_encode("arunaldarun482@gmail.com")."&user_id=".base64_encode("RSA883514");
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
$response = curl_exec($ch);
curl_close($ch);
print($response);
?>