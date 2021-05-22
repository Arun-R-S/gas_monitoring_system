<?php

        $error="";
if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $email=$_POST['email'];
    $pass=$_POST['password'];
    include 'db.php';

    $connect = mysqli_connect($servername, $username, $password , $database);
    $query = "SELECT * FROM user_info WHERE email='$email'";
    $result = mysqli_query($connect, $query);
    if($result->num_rows==0)
    {
      $flag=1;
      while($flag>0)
      {
        $useridst = "RSA". strval(mt_rand(100000, 999999));
        $query = "SELECT * FROM user_info WHERE user_id='$useridst'";
        $result = mysqli_query($connect, $query);
        if($result->num_rows==0)
        {
            $flag=0;
        }
      }
      date_default_timezone_set('Asia/Kolkata');
      $date = date('Y-m-d H:i:s a', time());
      $query = "INSERT INTO user_info (user_id, firstname, lastname, email, password, status, created) VALUES ('$useridst', '$firstname', '$lastname', '$email', '$pass', '0', '$date')";
      $result = mysqli_query($connect, $query);
      $query="INSERT INTO `testing` (`user_id`) VALUES ('$useridst')";
      $result = mysqli_query($connect, $query);
      $to_email = $email;
      $subject = "Mail Confirmation from Team AR";
      $body = "Hi ".$firstname." ".$lastname.",This is Activation Mail from Innovation Technoloigies.
      Thank You for Creating an Account in Iot Website
      Please Click the below link to Activate Your Account
      
      http://".$_SERVER['HTTP_HOST']."/project/gas_monitoring_system_testing/main/kvjsvkjnakfsbniadnfbkjbvuhbuiehbvuihbqeihboqiebiobqeivqeiorb/kvjsvkjnakfsbniadnfbkjbvuhbuiehbvuihbqeihboqiebiobqeivqeiorb.php?email=".base64_encode($email)."
      Stay Connected With us for further hepl";
      $headers = "From: innovationtechnologiespvtltd@gmail.com";

      if(mail($email, $subject, $body, $headers))
      {
        echo "ok";
        header('Location: confirm.php?value=1');
      }
      else {
        echo "not";
        header('Location: confirm.php?value=0');
      }
      
    }
    else
    {
      $error="Email is already registered!";
    }
  }
  else
  {
        $error="";
  }
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="User Sign Up">
  <meta name="author" content="Arun R S">
  <title>Create Account</title>
  <!-- Favicon -->
  <link rel="icon" href="../assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../assets/css/argon.css?v=1.2.0" type="text/css">
</head>

<body class="bg-default">
  <!-- Navbar -->
  <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="javascript:void(0)">
        <img src="../assets/img/brand/iot.png"> IoT Website
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="javascript:void(0)">
                <img src="../assets/img/brand/iot.png"> IoT Website
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <ul class="navbar-nav mr-auto">
          
          <li class="nav-item">
            <a href="login.php" class="nav-link ">
              <i class="ni ni-key-25 text-info"></i>
              <span class="nav-link-inner--text">Login</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="ni ni-circle-08 text-pink"></i>
              <span class="nav-link-inner--text">Create Account</span>
            </a>
          </li>
        </ul>
        <hr class="d-lg-none" />
        <ul class="navbar-nav align-items-lg-center ml-lg-auto">
          <li class="nav-item">
            <a class="nav-link nav-link-icon" href="https://www.facebook.com/profile.php?id=100009367277270" target="_blank" data-toggle="tooltip" data-original-title="Like us on Facebook">
              <i class="fab fa-facebook-square"></i>
              <span class="nav-link-inner--text d-lg-none">Facebook</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-icon" href="https://www.instagram.com/creativetimofficial" target="_blank" data-toggle="tooltip" data-original-title="Follow us on LinkedIn">
              <i class="fab fa-linkedin"></i>
              <span class="nav-link-inner--text d-lg-none">LinkedIn</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-icon" href="https://twitter.com/ArunRS0966" target="_blank" data-toggle="tooltip" data-original-title="Follow us on Twitter">
              <i class="fab fa-twitter-square"></i>
              <span class="nav-link-inner--text d-lg-none">Twitter</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-icon" href="https://github.com/17t104
" target="_blank" data-toggle="tooltip" data-original-title="Star us on Github">
              <i class="fab fa-github"></i>
              <span class="nav-link-inner--text d-lg-none">Github</span>
            </a>
          </li>
          <li class="nav-item d-none d-lg-block ml-lg-4">
            
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-7">
      <div class="container">
        <div class="header-body text-center mb-5">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white">Create an account</h1>
              <p class="text-lead text-white">Use these awesome forms to create new account in your project for free.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <!-- Table -->
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
          <div class="card bg-secondary border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                 <?php
    
  echo "<h5 class='text-red'>".$error."</h5>";
?>
                <small>Sign up with credentials</small>
              </div>
              <form role="form" method="POST" action="register.php">
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                    </div>
                    <input class="form-control" name="firstname" placeholder="First Name" type="text" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                    </div>
                    <input class="form-control" name="lastname" placeholder="Last Name" type="text" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" name="email" placeholder="Email" type="email" required>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" name="password" placeholder="Password" type="password" required>
                  </div>
                </div>
                
                <div class="row my-4">
                  <div class="col-12">
                    <div class="custom-control custom-control-alternative custom-checkbox">
                      <input class="custom-control-input" id="customCheckRegister" type="checkbox" required>
                      <label class="custom-control-label" for="customCheckRegister">
                        <span class="text-muted">I agree with the <a href="privacy_policy.html" target="_blank">Privacy Policy</a></span>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary mt-4">Create account</button>
                </div>
               
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-8">
              <a href="login.php" class="text-light"><small>Already Have an account? Login</small></a>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="py-5" id="footer-main">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-muted">
            &copy; 2020 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Team AR</a>
          </div>
        </div>
        <div class="col-xl-6">
          <ul class="nav nav-footer justify-content-center justify-content-xl-end">
            <li class="nav-item">
              <a href="#" class="nav-link" target="_blank">IoT Wesbite</a>
            </li>
          
          </ul>
        </div>
      </div>
    </div>
  </footer>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.2.0"></script>
</body>

</html>