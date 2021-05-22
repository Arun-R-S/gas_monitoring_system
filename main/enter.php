<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $email=$_POST['email'];
    $pass=$_POST['password'];
    include 'db.php';
    $connect = mysqli_connect($server, $user, $password , $database);
    $query = "SELECT firstname,lastname,password,status,user_id,gender FROM user_info WHERE email='$email'";
    $result = mysqli_query($connect, $query);
    if($result->num_rows==0)
    {
      $error="Email is Incorrect!";
    }
    else
    {
      $row=$result->fetch_assoc();
      if($row['password']==$pass)
      {
        if($row['status']==0)
        {
          
          $error="Activate Your Account Please!!";
        }
        else
        {
          $error="All correct";
          session_start();
          $_SESSION['userid']=$row['user_id'];
          $_SESSION['firstname']=$row['firstname'];
          $_SESSION['lastname']=$row['lastname'];
          $_SESSION['gender']=$row['gender'];
          
        }
      }
      else
      {
        $error="Password is Incorrect";
      }
    }

  }
  else
  {
        $error="";
  }
?>