<?php
session_start();
$username=$_POST['username'];
$password=$_POST['password'];

include('conn.php');
$sql="SELECT * FROM `users` where username = '$username' and `password`='$password' ";



$r = mysqli_query($con,$sql);
$count = mysqli_num_rows($r);
if($count>0)
{
     $_SESSION['username']=$username;
echo 1;
   
    
}
else
{
echo 0;
}
	


?>