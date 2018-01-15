

<?php include('header.php');?>
    <!--sidebar-menu-->

    <!--main-container-part-->
    <div id="content">
        <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
        </div>


        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Vehicle Registration</h5>
          </div>
          <div class="widget-content nopadding">
            <form action="reg_vehicle.php" method="POST" class="form-horizontal">
              <div class="control-group">

                <div class="control-group">
                  <label class="control-label">Select the owner</label>
                  <div class="controls">
                    <select name="owner_id">
<?php

include('connection.php');
$sql= "SELECT * FROM `vehicle_owners`";

$r2 = mysqli_query($con,$sql);
$result = array();
while($row= mysqli_fetch_array($r2))
{
  $id_number = $row['id_number'];
  $name =      $row['name'];

  echo '  <option> '.$id_number.'  </option>';

}
 ?>

<!--
 <option>Name</option> -->



                    </select>
                  </div>
                </div>


              </div>
              <div class="control-group">

                <div class="controls">
                  <input type="text" class="span11" required="" name="number_plate"placeholder="Vehicle Number plate" />
                </div>
              </div>
              <div class="control-group">

                <div class="controls">
                  <input type="text"  class="span11"  required="" name="model" placeholder="Vehicle model"  />
                </div>
              </div>

              <div class="control-group">

                <div class="controls">
                  <input type="text"  class="span11" required="" name="info" placeholder="Any additional information"  />
                </div>
              </div>



              <div class="control-group">
                <div class="controls">
                  <button type="submit" class="btn btn-success">Save vehicle</button>
                </div>
              </div>


<?php

if(isset($_POST['model']))
{


$user_id = $_POST['owner_id'];
$number_plate = $_POST['number_plate'];
$model = $_POST['model'];
$info = $_POST['info'];


$sql="INSERT INTO `vehicles` (`id`, `number_plate`, `vehicle_make`, `owner`) VALUES (NULL, '$number_plate', '$model', '$user_id')";
$result= mysqli_query($con, $sql);

if($result)
{

  $sql="SELECT * FROM `stop_overs`";
  $r2 = mysqli_query($con,$sql);
  while($row= mysqli_fetch_array($r2))
  {
    $place_name = $row['place_name'];

  $sql="INSERT INTO `vehiclle_queus` (`id`, `number_plate`, `timestamp`, `stage`, `vehicle_condition`, `position`) VALUES
   (NULL, '$number_plate', CURRENT_TIMESTAMP, '$place_name ', 'GOOD', 'null')";
   $insertr = mysqli_query($con, $sql);

  }

  if($insertr)
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

  echo "<script>alert('Registration Failed. Please try again later');</script>";

}


}

 ?>



            </form>
          </div>
        </div>

    </div>

    <!--end-main-container-part-->


<?php include('footer.php');?>
