<?php

    function email()
    {
        return base64_decode($_REQUEST['email']);
    }
    function getIds()
    {
        include 'db.php';
        $user_id = base64_decode($_REQUEST['user_id']);
        $conn = mysqli_connect($servername, $username, $password, $database);
        $query1 = "SELECT * from notification_onesignal where user_id='$user_id' ORDER BY `time` DESC LIMIT 3";
        $result1 = $conn->query($query1);
        while($row = $result1->fetch_array())
        {
            $rows[] = $row['subscriber_id'];
        }
        return $rows;
    }
    function name()
    {
        include 'db.php';
        $user_id = base64_decode($_REQUEST['user_id']);
        $conn = mysqli_connect($servername, $username, $password, $database);
        $query1 = "SELECT * from user_info where user_id='$user_id'";
        $result1 = $conn->query($query1);
        while($row = $result1->fetch_array())
        {
            return $row['firstname'];
        }
        
    }
    
   function sendMessage(){
        $email=email();
        $heading = array(
            "en" => 'Gas Leakage Warning('.$email.')',
            );
        $content = array(
            "en" => 'Dear '.name().' your IoT system detects the gas leakage. Reported account: '.$email,
            );
        $fields = array(
            'app_id' => "fa12e022-056e-45ea-b8fa-cd94fc372997",
            'heading' => 'IoT Website',
            'include_player_ids' => getIds(),
            'data' => array("foo" => "bar"),
            'contents' => $content,
            'headings' => $heading,
            'url' => 'http://192.168.43.132/project/gas_monitoring_system_testing/main/open_notification.php?email='.base64_encode($email),
            'big_picture'=> 'https://arunrs.000webhostapp.com/images/attention.jpg',
            'content_available' => true,
            'chrome_web_image' => 'http://arunrs.000webhostapp.com/images/favicon5.png',
            'chrome_big_picture' => 'http://arunrs.000webhostapp.com/images/favicon5.png',
        );
        
        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response;
    }
    
    $response = sendMessage();
    $return["allresponses"] = $response;
    $return = json_encode( $return);
    
    print("\n\nJSON received:\n");
    print($return);
    print("\n"); 
?>