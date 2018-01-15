<?php
session_start();


	//it will never let you open index(login) page if session is set
	if ( isset($_SESSION['username'])=="" )
    {
		header("Location: login.html");
		exit;
	  }

$username = $_SESSION['username'];
$isadmin = $_SESSION['isadmn'];
$stage= $_SESSION['stage'];

// echo $stage;
// echo $isadmin;
// echo $username;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kiemwa Sacco</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="css/fullcalendar.css" />
    <link rel="stylesheet" href="css/matrix-style.css" />
    <link rel="stylesheet" href="css/matrix-media.css" />
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/jquery.gritter.css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

    <!--Header-part-->
    <div id="header">
        <h1><a href="index.php">Kiemwa Sacco</a></h1>
    </div>
    <!--close-Header-part-->


    <!--top-Header-menu-->
    <div id="user-nav" class="navbar navbar-inverse">
        <ul class="nav">

            <li class="dropdown" id="profile-messages"><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>

                <!-- <span class="text">Welcome</span><b class="caret"></b></a> -->
                <ul class="dropdown-menu">
                    <!-- <li><a href="#"><i class="icon-user"></i> My Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="icon-check"></i> My Tasks</a></li>
                    <li class="divider"></li> -->
                    <li><a href="login.html"><i class="icon-key"></i> Log Out</a></li>
                </ul>
            </li>


            <li class=""><a title="" href="login.html"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
        </ul>
    </div>

    <!-- <div id="search">
        <input type="text" placeholder="Search here..." />
        <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
    </div> -->

    <div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
        <ul>
            <li ><a href="index.php"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>




            <li> <a href="trips_made.php"><i class="icon icon-inbox"></i> <span>Trips made</span></a> </li>

<?php
if($isadmin=='true')
{
  ?>

              <li> <a href="regusers.php"><i class="icon icon-signal"></i> <span>Register / Edit users</span></a> </li>

              <li><a href="reg_vehicle.php"><i class="icon icon-star"></i></i><span>Register Vehicles</span></a></li>

              <li> <a href="revenue.php"><i class="icon icon-signal"></i> <span>Revenue collected</span></a> </li>



  <?php
}


 ?>



        </ul>
    </div>
