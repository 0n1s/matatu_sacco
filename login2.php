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

  while($row2 = mysqli_fetch_array($r))
  {

$stage= $row2['stage'];
$isadmin= $row2['isadmin'];

  }

$_SESSION['username']=$username;
$_SESSION['isadmn']=$isadmin;
$_SESSION['stage'] =  $stage;


echo 1;


}
else
{
echo 0;
}



?>
