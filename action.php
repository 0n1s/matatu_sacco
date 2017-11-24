<?php include('header.php');
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

?>
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
    </div>


<?php


if(isset($_GET['number_plate']))
{
      $action = $_GET['action'];
      $number_plate = $_GET['number_plate'];
      include('connection.php');
      if($action == 'arrival_report')
    {

        $current_location= $_GET['current_location'];
        $sql= "SELECT * FROM `vehicle_locations` where `number_plate` = '$number_plate'";
        $r= mysqli_query($con, $sql);


        $count = mysqli_num_rows($r);
        if($count>0)
        {
          $sql = "UPDATE `vehicle_locations` SET `current_locatiom` = '$current_location' WHERE `vehicle_locations`.`number_plate` = '$number_plate'";
          if(mysqli_query($con, $sql))
          {

            echo '
            <script type="text/javascript">

                  function getConfirmation()
                  {
                     var retVal = confirm("Vehicle arrival acknowledged!");
                     if( retVal == true ){
                       window.location.href = "detailed_queue.php?place_id='.$current_location.'";

                        return true;
                     }
                     else{
                         window.location.href = "detailed_queue.php?place_id='.$current_location.'";

                        return false;
                     }
                  }

                  getConfirmation();

            </script>

            ';



          }
        }
        else
        {
          $sql = "INSERT INTO `vehicle_locations` (`id`, `number_plate`, `current_locatiom`, `next_location`) VALUES (NULL, '$number_plate', '$current_location', 'empty')";
          if(mysqli_query($con, $sql))
          {


            echo '
            <script type="text/javascript">

                  function getConfirmation()
                  {
                     var retVal = confirm("Vehicle arrival acknowledged!");
                     if( retVal == true ){
                       window.location.href = "detailed_queue.php?place_id='.$current_location.'";

                        return true;
                     }
                     else{
                         window.location.href = "detailed_queue.php?place_id='.$current_location.'";

                        return false;
                     }
                  }

                  getConfirmation();

            </script>

            ';



          }
        }




 }
 else if($action == 'breakdown_report')
 {



           $current_location= $_GET['current_location'];

           $sql= "SELECT * FROM `vehicle_locations` where `number_plate` = '$number_plate'";
           $r= mysqli_query($con, $sql);
           $current_location1="Vehicle broke down near ".$current_location;
           $count = mysqli_num_rows($r);
           if($count>0)
           {
             $sql = "UPDATE `vehicle_locations` SET `current_locatiom` = '$current_location1' WHERE `vehicle_locations`.`number_plate` = '$number_plate'";
             if(mysqli_query($con, $sql))
             {


               $sql="UPDATE `vehiclle_queus` SET `vehicle_condition` = 'BROKEDOWN' WHERE `vehiclle_queus`.`	number_plate` = '$number_plate'";
               if(mysqli_query($con, $sql))
               {

               }

               echo '
               <script type="text/javascript">

                     function getConfirmation()
                     {
                        var retVal = confirm("Vehicle breakdown acknowledged!");
                        if( retVal == true ){
                          window.location.href = "detailed_queue.php?place_id='.$current_location.'";

                           return true;
                        }
                        else{
                            window.location.href = "detailed_queue.php?place_id='.$current_location.'";

                           return false;
                        }
                     }

                     getConfirmation();

               </script>

               ';



             }
           }
           else
           {
             $sql = "INSERT INTO `vehicle_locations` (`id`, `number_plate`, `current_locatiom`, `next_location`) VALUES (NULL, '$number_plate', '$current_location1', 'empty')";
             if(mysqli_query($con, $sql))
             {


               $sql="UPDATE `vehiclle_queus` SET `vehicle_condition` = 'BROKEDOWN' WHERE `vehiclle_queus`.`	number_plate` = '$number_plate'";
               if(mysqli_query($con, $sql))
               {

               }

               echo '
               <script type="text/javascript">

                     function getConfirmation()
                     {
                        var retVal = confirm("Vehicle breakdown acknowledged!");
                        if( retVal == true ){
                          window.location.href = "detailed_queue.php?place_id='.$current_location.'";

                           return true;
                        }
                        else{
                            window.location.href = "detailed_queue.php?place_id='.$current_location.'";

                           return false;
                        }
                     }

                     getConfirmation();

               </script>

               ';



             }
           }




 }



}



 ?>


       <script type="text/javascript">

             function getConfirmation()
             {
                var retVal = confirm("Do you want to continue ?");
                if( retVal == true ){
                   document.write ("User wants to continue!");
                   return true;
                }
                else{
                   document.write ("User does not want to continue!");
                   return false;
                }
             }

       </script>



</div>
<?php include('footer.php');?>
