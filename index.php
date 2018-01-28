<?php include('header.php');?>
    <!--sidebar-menu-->
<script src="js/jquery.dataTables.min.js"></script>
    <!--main-container-part-->
    <div id="content">
        <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
        </div>
        <!--End-breadcrumbs-->

        <!--Action boxes-->
        <div class="container-fluid">
            <div class="quick-actions_homepage">
                <ul class="quick-actions">



<!--                    <li class="bg_lg span3"> <a href="charts.html"> <i class="icon-signal"></i> Charts</a> </li>-->
<?php
include('connection.php');
if($isadmin == 'true')
{
  $sql ="SELECT * FROM `stop_overs`";
}
else
{
$sql ="SELECT * FROM `stop_overs` where `place_name` ='$stage'";
}

//echo $sql;
$r = mysqli_query($con,$sql);
$result = array();
while($row = mysqli_fetch_array($r))
{
  $place_name = $row['place_name'];
  $place_id = $row['id'];
  $link="detailed_queue.php?place_id=".$place_name;
?>
<li class="bg_ls"> <a href=<?php echo $link?>> <i class="icon-tint"></i><?php echo $place_name ?> (Click for more) </a> </li>
<!--Chart-box-->
<div class="row-fluid">


  <div class="widget-box">
    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
      <h5> Vehicle departure queue in <?php echo $place_name ?> </h5>
    </div>
    <div class="widget-content nopadding">
      <table class="table table-bordered data-table">
        <thead>
          <tr>
            <th>Position</th>
            <th>Vehicle reg number</th>
            <th>Last travelled</th>
            <th>Stage name</th>
<!--            <th>Next destination</th>-->
            <th>Vehicle status</th>
          </tr>
        </thead>
          <tbody>

        <?php
        include('connection.php');
        //SELECT * FROM `vehiclle_queus` ORDER BY `vehiclle_queus`.`timestamp` DESC
        $sql ="SELECT * FROM `vehiclle_queus`  WHERE `stage` ='$place_name'   ORDER BY timestamp DESC";
        //SELECT * FROM `vehiclle_queus` ORDER BY `vehiclle_queus`.`timestamp` DESC
        $r2 = mysqli_query($con,$sql);
        $count = mysqli_num_rows($r2);
        $post=$count;
        $result = array();
        while($row2 = mysqli_fetch_array($r2))
        {
$number_plate=$row2['number_plate'];
$sql="UPDATE `vehiclle_queus` SET `position` = '$post' WHERE `number_plate` = '$number_plate'";
mysqli_query($con,$sql);
        ?>

        <tr class="gradeX">
          <td><?php echo $post; $post--; ?></td>
          <td><?php echo $row2['number_plate'] ?> </td>
          <td><?php echo $row2['timestamp'] ?></td>
          <td><?php echo $row2['stage'] ?></td>
<!--          <td>Kisii</td>-->
          <td><?php echo $row2['vehicle_condition'] ?> </td>
        </tr>
        <?php

        }

        ?>
        </tbody>
      </table>
    </div>
  </div>

<?php

}

?>


                </ul>
            </div>
            </div>
            <!--End-Chart-box-->
            <hr/>

        </div>
    </div>

    <!--end-main-container-part-->


<?php include('footer.php');?>
