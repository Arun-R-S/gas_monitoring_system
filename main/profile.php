<?php

   if( isset( $_COOKIE['user_id'] ) ) {

    // Create connection
        date_default_timezone_set('Asia/Kolkata');
        $id=$_COOKIE['user_id'];
        include 'db.php';
        $conn = new mysqli($servername, $username, $password, $database);
        $dat=date("Y-m-d");
    $conn = new mysqli($servername, $username, $password, $database);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $update = date("Y-m-d G:i:s");
    if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $fname=$_POST['firstname'];
    $lname=$_POST['lastname'];
    $age=$_POST['age'];
    $gender=$_POST['gender'];
    $dob=$_POST['dob'];
    $degree=$_POST['degree'];
    $college=$_POST['college'];
    $address1=$_POST['address1'];
    $address2=$_POST['address2'];
    $city=$_POST['city'];
    $country=$_POST['country'];
    $state=$_POST['state'];
    $pincode=$_POST['pincode'];
    $mobile_no=$_POST['mobile_no'];
    $alter_mobile=$_POST['alter_mobile'];
    if($alter_mobile==0)
      $alter_mobile="NULL";
    $project_name=$_POST['project_name'];
    $about_website=$_POST['about_website'];
    $id=$_COOKIE['user_id'];
    $sql = "UPDATE `user_info` SET `firstname` = '$fname',`lastname` = '$lname',`age` = '$age',`gender` = '$gender',`dob` = '$dob',`degree` = '$degree',`college` = '$college',`address1` = '$address1',`address2` = '$address2',`city` = '$city',`country` = '$country',`state` = '$state',`pincode` = '$pincode',`mobile_no` = '$mobile_no',`alter_mobile` = '$alter_mobile',`project_name` = '$project_name',`about_website` = '$about_website',`status` = '1', `profile_update`='$update' WHERE `user_info`.`user_id` = '$id'";
    $result = mysqli_query($conn, $sql);
    header('Location: profile.php');
    die();
  }
    $sql = "INSERT INTO visits (user_id,dates) VALUES ('$id','$dat')";
    $conn->query($sql);
    $query = "SELECT * FROM user_info WHERE user_id='$id'";
    $result = mysqli_query($conn, $query);
    $row=$result->fetch_assoc();
    if($row['allowing']=="NO")
        {
          unset($_COOKIE['user_id']); 
          setcookie('user_id', null, -1, '/');
          header('Location: blocked.php');
          die();
        }
        if($row['mail_confirm']==0)
        {
          header('Location: activate.php');
          die();
        }
    function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
    $lastmod=time_elapsed_string($row['profile_updated']);
   }else {

     header("Location: login.php");
     die();
   }
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
  
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Your Profile">
  <meta name="author" content="Arun R S">
  <title>Profile Page</title>
  <!-- Favicon -->
  <link rel="icon" href="../assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../assets/css/argon.css" type="text/css">

  <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
  <script src="notification.js"></script>
</head>

<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
<div class="scrollbar-inner">
      <!-- Brand -->

      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="../assets/img/brand/blue.png" class="navbar-brand-img" alt="...">  IoT Website
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="../index.php">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link active" href="#">
                <i class="ni ni-single-02 text-yellow"></i>
                <span class="nav-link-text">Profile</span>
              </a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="login.php">
                <i class="ni ni-key-25 text-info"></i>
                <span class="nav-link-text">Login</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="register.php">
                <i class="ni ni-circle-08 text-pink"></i>
                <span class="nav-link-text">Register</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="live.php">
                <i class="ni ni-send text-dark"></i>
                <span class="nav-link-text">Live Track</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../summary.php">
                <i class="ni ni-bullet-list-67 text-default"></i>
                <span class="nav-link-text">Summary</span>
              </a>
            </li>
          </ul>
          <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal"></span>
          </h6>
          <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
            <h5>Close</h5>
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
        </div>
      </div>
    </div>
</nav>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-default border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Search form -->
          <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
            <h6 class="h2 text-white d-inline-block mb-0">Profile</h6>
            
            
            <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
              <span aria-hidden="false">×</span>
            </button>
          </form>
              <!-- Topnav -->

          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
            <li class="nav-item d-sm-none">
              <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <i class="ni ni-zoom-split-in"></i>
              </a>
            </li>
            
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ni ni-ungroup"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-dark bg-default  dropdown-menu-right ">
                <div class="row shortcuts px-4">
                  <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-red">
                      <i class="ni ni-calendar-grid-58"></i>
                    </span>
                    <small>Calendar</small>
                  </a>
                  <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-orange">
                      <i class="ni ni-email-83"></i>
                    </span>
                    <small>Email</small>
                  </a>
                  <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-info">
                      <i class="ni ni-credit-card"></i>
                    </span>
                    <small>Payments</small>
                  </a>
                  <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-green">
                      <i class="ni ni-books"></i>
                    </span>
                    <small>Reports</small>
                  </a>
                  <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-purple">
                      <i class="ni ni-pin-3"></i>
                    </span>
                    <small>Maps</small>
                  </a>
                  <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-yellow">
                      <i class="ni ni-basket"></i>
                    </span>
                    <small>Shop</small>
                  </a>
                </div>
              </div>
            </li>
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="" src="../assets/img/theme/<?php echo $row['gender'];?>.jpg">
                  </span>
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold"><?php echo $row['firstname']." ".$row['lastname'] ?></span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu  dropdown-menu-right ">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Welcome!</h6>
                </div>
                <a href="#" class="dropdown-item">
                  <i class="ni ni-single-02"></i>
                  <span>My profile</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ni ni-settings-gear-65"></i>
                  <span>Settings</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ni ni-calendar-grid-58"></i>
                  <span>Activity</span>
                </a>
                <a class="dropdown-item">
                  <i class="ni ni-support-16"></i>
                  <span>IP:<?php echo get_client_ip();?></span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="logout.php" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Logout</span>
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <!-- Header -->
    <div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(../assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <?php 
            if(isset($_REQUEST['value'])==1)
            {
              echo "<h2 class='text-yellow'> Update your profile to proceed</h2>";
            }
            ?>
            <h1 class="display-2 text-white">Hello, <?php echo $row['firstname'];?></h1>
            <p class="text-white mt-0 mb-5">This is your profile page. You can update your personal details here.<br>Last Edited: <?php echo $lastmod;?><br></p>
            
            
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-4 order-xl-2">
          <div class="card card-profile">
            <img src="../assets/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="../assets/img/theme/<?php echo $row['gender'];?>.jpg" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
                
              </div>
            </div>
            <div class="card-body pt-0">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center">
                    <div>
                      <span class="heading"><?php include 'profile/total.php';?></span>
                      <span class="description">Total Visit</span>
                    </div>
                    <div>
                      <span class="heading"><?php include 'profile/today.php';?></span>
                      <span class="description">Today</span>
                    </div>
                    <div>
                      <span class="heading"><?php include 'profile/this week.php';?></span>
                      <span class="description">This Week</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h5 class="h3">
                  <?php echo $row['firstname'];?> <?php echo $row['lastname'];?><span class="font-weight-light">, <?php echo $row['age'];?></span>
                </h5>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i><?php echo $row['city'];?>, <?php echo $row['state'];?>
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i><?php echo $row['degree'];?>
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i> <?php echo $row['college'];?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card">
            <form method="POST" action="profile.php">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Edit profile </h3>
                  <h5 class='text-red'> <!--This is for testing purpose. Original information is not mandatory.--></h5>
                </div>
                <div class="col-4 text-right">
                  <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
              </div>
            </div>
            <div class="card-body">
              
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">User ID</label>
                        <input type="text" name="uname" id="input-username" class="form-control btn-icon-clipboard" data-clipboard-text="<?php echo $row['user_id'];?>" title="" data-original-title="Copy to clipboard" placeholder="Username" value="<?php echo $row['user_id'];?>" readonly >
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label>
                        <input type="email" id="input-email" class="form-control" value="<?php echo $row['email'];?>" placeholder="Email" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">First name</label>
                        <input type="text" id="input-first-name" class="form-control" placeholder="First name" value="<?php echo $row['firstname'];?>" name="firstname" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Last name</label>
                        <input type="text" id="input-last-name" class="form-control" placeholder="Last name" value="<?php echo $row['lastname'];?>" name="lastname" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Age</label>
                        <input type="number" id="input-first-name" class="form-control" placeholder="Age" name="age" value="<?php echo $row['age'];?>" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control" ><?php
                                if($row['gender']=="Male")
                                {
                                    $s1="selected";
                                    $s2="";
                                    $s3="";
                                }
                                else if($row['gender']=="Female")
                                {
                                    $s1="";
                                    $s2="selected";
                                    $s3="";
                                }
                                else
                                {
                                    $s1="";
                                    $s2="";
                                    $s3="selected";
                                }
                            ?>
                              <option value="Male" <?php echo $s1;?>>Male</option>
                              <option value="Female" <?php echo $s2;?>>Female</option>
                              <option value="Others" <?php echo $s3;?>>Others</option>
                            </select>
                        <h5 class="text-red">Profile picture set automatically based on gender.</h5>
                      </div>

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Date of Birth</label>
                        <input type="date" id="input-first-name" class="form-control" placeholder="Birth Date" value="<?php echo $row['dob'];?>" name="dob" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Degree & Branch</label>
                        <input type="text" id="input-last-name" class="form-control" placeholder="Educational Qualification" value="<?php echo $row['degree'];?>" name="degree" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">College Name</label>
                        <input type="text" id="input-last-name" class="form-control" placeholder="College Name" value="<?php echo $row['college'];?>" name="college" required>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Address line 1</label>
                        <input id="input-address" class="form-control" placeholder="Home Address 1" name="address1" value="<?php echo $row['address1'];?>" type="text" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Address line 2 (Optional)</label>
                        <input id="input-address" class="form-control" placeholder="Home Address 2" name="address2" value="<?php echo $row['address2'];?>" type="text">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">City</label>
                        <input type="text" id="input-city" class="form-control" placeholder="City" name="city" value="<?php echo $row['city'];?>" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">State</label>
                        <input type="text" id="input-state" class="form-control" name="state" value="<?php echo $row['state'];?>" placeholder="State" required>
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Country</label>
                        <input type="text" id="input-country" class="form-control" name="country" placeholder="Country" value="<?php echo $row['country'];?>" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Pin code</label>
                        <input type="number" id="input-postal-code" class="form-control" name="pincode" value="<?php echo $row['pincode'];?>" placeholder="Postal code" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Mobile Number</label>
                        <input type="number" id="input-first-name" class="form-control" name="mobile_no" placeholder="Mobile" value="<?php echo $row['mobile_no'];?>" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Alternate Number (Optional)</label>
                        <input type="number" name="alter_mobile" id="input-last-name" class="form-control" placeholder="Alter Mobile" value="<?php echo $row['alter_mobile'];?>">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Description -->
                <h6 class="heading-small text-muted mb-4">About Your Project</h6>
                 
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Your Project Name</label>
                        <input type="text" name="project_name" id="input-first-name" class="form-control" placeholder="Project Name" value="<?php echo $row['project_name'];?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Tell us Why you choose our site</label>
                    <textarea rows="4" name="about_website" class="form-control" placeholder="A few words about you ..." required><?php echo $row['about_website'];?></textarea>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
     <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6">
            <div class="copyright text-center  text-lg-left  text-muted">
              &copy; 2020 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank"> Team AR</a>
            </div>
          </div>
          <div class="col-lg-6">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
              <li class="nav-item">
                <a href="#" class="nav-link"><?php echo $row['project_name'];?></a>
              </li>
              
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js"></script>
  <script src="../assets/vendor/clipboard/dist/clipboard.min.js"></script>

</body>

</html>