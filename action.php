<?php include('header.php');


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

      echo $action;

      if($action === 'arrival_report')
    {
      echo $action;

        $current_location= $_GET['current_location'];
        $sql= "SELECT * FROM `vehicle_locations` where `number_plate` = '$number_plate'";
        $r= mysqli_query($con, $sql);
        $count = mysqli_num_rows($r);
        if($count>0)
        {
          echo $count;
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
          $sql = "INSERT INTO `vehicle_locations` (`id`, `number_plate`, `current_locatiom`, `next_location`)
          VALUES (NULL, '$number_plate', '$current_location', 'empty')";

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
          else {
echo "Registration failed!!!";

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

 else if($action == 'departing_report')
 {

$number_plate= $_GET['number_plate'];
//monthly collections = 50000
$monthly_collections = 50000;

$now = new \DateTime('now');
$month = $now->format('m');
$year = $now->format('Y');
$now_month = $month;

$month_from_db =  date('m', strtotime("2018-01-15 19:05:14"));

$sql = "SELECT * FROM `revenues` WHERE  `vehicle` = '$number_plate' ";
$r = mysqli_query($con,$sql);
$count = mysqli_num_rows($r);
if($count>0)
{
  $total_amt = 0;
  while($row2 = mysqli_fetch_array($r))
{
$time_from_db = $row2['date'];
$month_from_db =  date('m', strtotime($time_from_db));
if($month_from_db === $month_from_db )
{
$amt_from_db = $row2['revenue_collected'];
$total_amt=$total_amt+$amt_from_db;
}

}

if($total_amt > $monthly_collections )
{

// $sql =  "SELECT * FROM `vehicle_locations` WHERE `current_locatiom` = '$current_location' ";
// $r = mysqli_query($con,$sql);
// $count = mysqli_num_rows($r);
// $results = array();
// while($row2 = mysqli_fetch_array($r))
// {
// $number_plate = $row2['number_plate'];
// $results[] = $number_plate;
// }
// $size_of_number_plates = sizeof($results);
// for($i=0; $i < $size_of_number_plates; $i++)
// {
//   $number_plate = $results[$i];
//   $sql = "SELECT * FROM `revenues` WHERE  `vehicle` = '$number_plate' ";
//   $r = mysqli_query($con,$sql);
//   $count = mysqli_num_rows($r);
//   if($count>0)
//   {
//     $total_amt = 0;
//     while($row2 = mysqli_fetch_array($r))
//   {
//   $time_from_db = $row2['date'];
//   $month_from_db =  date('m', strtotime($time_from_db));
//   if($month_from_db === $month_from_db )
//   {
//   $amt_from_db = $row2['revenue_collected'];
//   $total_amt=$total_amt+$amt_from_db;
//   }
//   }
// if($totalamt<$monthly_collections)
// {
// //vehicle can go
// }
// else
// {
//   # code...
// }
// }
//   else
//   {
// //vehicle has 0 revenues
//   }
// }

?>

<script>
function getConfirmation()
{


   var retVal = confirm("Please select another vehicle. This one has already achieved our goal.");
   if( retVal == true )
   {
     window.location.href = "index.php";
      return true;
   }
   else
   {
       window.location.href = "index.php";
      return false;
   }
}

getConfirmation();
</script>

<?php
  exit();
}

}else
{
$amt = 0;




}


   //http://localhost/kiemwa/action.php?number_plate=KBC%20344%20N&current_location=Nyeri&action=departing_report&destination=Unknown

    $current_location=$_GET['current_location'];
    $destination=$_GET['destination'];

//http://localhost/kiemwa/action.php?number_plate=KDB%20567%20G&current_location=Karatina&action=departing_report&destination=%20Nairobi&totalamt=0
$totalamt=$_GET['totalamt'];


 $sql= "UPDATE `vehiclle_queus` SET `timestamp` = CURRENT_TIMESTAMP  WHERE `number_plate` = '$number_plate' and `stage` = '$current_location'";
 echo $sql;
 if(mysqli_query($con,$sql))
 {

//$fare_total=$fare_total*1;
$fare=$fare*1;
$fare = $totalamt;

   $sql= "INSERT INTO `revenues` (`sNo`, `vehicle`, `destination_from`, `destination_to`, `revenue_collected`, `date`)
   VALUES (NULL, '$number_plate', '$current_location', '$destination', '$fare', CURRENT_TIMESTAMP)";
   mysqli_query($con,$sql);


    echo "sql query ->".$sql;




     $SQL="INSERT INTO `departure_records` (`id`, `number_plate`, `start_location`, `stop_destination`, `departure_time`) VALUES
           (NULL, '$number_plate', '$current_location', '$destination', CURRENT_TIMESTAMP)";
     mysqli_query($con,$SQL);

   echo '
   <script type="text/javascript">

         function getConfirmation()
         {
            var retVal = confirm("Vehicle departure recorded!");
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
