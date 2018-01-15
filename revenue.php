<?php
include('header.php');

?>

<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
    </div>


    <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Select vehicle!</h5>
        </div>
        <div class="widget-content nopadding">
            <form action="revenue.php" method="POST" class="form-horizontal">
                <div class="control-group">

                    <div class="control-group">
                        <label class="control-label">Select the vehicle</label>
                        <div class="controls">
                            <select name="number_plate">
<?php

include('connection.php');
$sql= "SELECT * FROM `vehicles`";
$r2 = mysqli_query($con,$sql);
$result = array();
while($row= mysqli_fetch_array($r2))
{
  $id_number = $row['number_plate'];
  $name =      $row['name'];
  echo " <option> ".$id_number."  </option>";
}
 ?>
                  </select>
                        </div>
                    </div>




                </div>

                <div class="control-group">
                    <div class="control-group">

                        <label class="control-label">View Revenue collected</label>
                        <div class="controls">
                            <button class="btn btn-primary">View</button>
                        </div>



                    </div>

                </div>





            </form>
        </div>



        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Trips made</h5>
            </div>


            <div class="widget-content nopadding">
                <table class="table table-bordered data-table" id="#customers">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Number plate</th>
                            <th>Departure location</th>
                            <th>Destination location</th>
                            <th>Date</th>
                            <th>Ammount</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                  if(isset($_POST['number_plate']))
{

                      $number_plate= $_POST['number_plate'];
$sql = "SELECT * FROM `revenues` where `vehicle` = '$number_plate' ";


//$sql ="SELECT * FROM `vehiclle_queus`  WHERE `stage` ='$place_name'   ORDER BY timestamp DESC";
        //SELECT * FROM `vehiclle_queus` ORDER BY `vehiclle_queus`.`timestamp` DESC
        $r2 = mysqli_query($con,$sql);
        $count = mysqli_num_rows($r2);
        $post=$count;
        $result = array();
        $tamount = 0;
        while($row2 = mysqli_fetch_array($r2))
        {
        ?>

                            <tr class="gradeX">
                                <td>
                                    <?php echo $post; $post--; ?>
                                </td>
                                <td>
                                    <?php echo $row2['vehicle'] ?> </td>
                                <td>
                                    <?php echo $row2['destination_from'] ?>
                                </td>
                                <td>
                                    <?php echo $row2['destination_to'] ?>
                                </td>
                                <td>
                                    <?php echo $row2['date'] ?> </td>

                                    <td>
                                        <?php echo $row2['revenue_collected'];
$tamount= $tamount + $row2['revenue_collected'];

                                         ?> </td>
                            </tr>
                            <?php

        }







}


                  ?>


                    </tbody>


                    <tfoot>
                        <tr>
                            <th>Total</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><?php echo $tamount ;?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>



<script>


</script>

<?php
include('footer.php');
?> ?>
