<?php
include('header.php');
?>


<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
    </div>


    <div class="widget-box">
      <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
        <h5>User registration</h5>
      </div>
      <div class="widget-content nopadding">
        <form action="regusers.php" method="POST" class="form-horizontal">
          <div class="control-group">

            <div class="control-group">
              <label class="control-label">Select the stage</label>
              <div class="controls">
                <select name="stage">
<?php

include('connection.php');
$sql= "SELECT * FROM `stop_overs`";

$r2 = mysqli_query($con,$sql);
$result = array();
while($row= mysqli_fetch_array($r2))
{
$id_number = $row['place_name'];
$name =      $row['id'];

echo '  <option> '.$id_number.'  </option>';

}
?>

                </select>
              </div>
            </div>


          </div>
          <div class="control-group">

            <div class="controls">
              <input type="text" class="span11" required="" name="name"placeholder="Name" />
            </div>
          </div>
          <div class="control-group">

            <div class="controls">
              <input type="text"  class="span11"  required="" name="username" placeholder="Username"  />
            </div>
          </div>

          <div class="control-group">

            <div class="controls">
              <input type="text"  class="span11" required="" name="password" placeholder="Password"  />
            </div>
          </div>



          <div class="control-group">
            <div class="controls">
              <button type="submit" class="btn btn-success">Save user</button>
            </div>
          </div>


<?php

if(isset($_POST['name']))
{


$name = $_POST['name'];
$username = $_POST['username'];
$stage = $_POST['stage'];
$password = $_POST['password'];

echo
"<script>
console.log(".$stage.");
</script>";


$sql="INSERT INTO `users` (`sNo`, `username`, `password`, `stage`, `isadmin`) VALUES (NULL, '$username', '$password', '$stage', 'false')";
$result= mysqli_query($con, $sql);

if($result)
{
echo "<script>alert('Registration Success.');</script>";
}

else
{

echo "<script>alert('Registration Failed. Please try again later');</script>";

}


}
else
{
  echo
  "<script>
  console.log('misssing smtn');
  </script>";
}





?>



        </form>
      </div>
    </div>

</div>



<?php

include('footer.php');

 ?>
