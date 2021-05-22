<?php
	unset($_COOKIE['admin_id']); 
    setcookie('admin_id', null, -1, '/'); 
    header('Location: adminlogin.php');
    die();
?>