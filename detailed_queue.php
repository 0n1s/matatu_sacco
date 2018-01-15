<?php include('header.php');?>
<div id="content">


    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
    </div>




    <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5> Vehicle departure queue in
                <?php

            echo $_GET['place_id'];

            $place_id= $_GET['place_id'];


            ?>
            </h5>
        </div>
        <div class="widget-content nopadding">
            <table class="table table-bordered data-table" id="table_click">
                <thead>
                    <tr>
                        <th>Postion</th>
                        <th>Vehicle reg number</th>
                        <th>Current location</th>
                        <th>Next destination</th>

                        <th>Viable Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <?php


if(!isset($_GET['place_id']))
{

}

          $place_id=$_GET['place_id'];
          include('connection.php');
          $sql ="SELECT * FROM `vehiclle_queus` WHERE `stage` = '$place_id' ORDER BY timestamp DESC";
          //SELECT * FROM `vehiclle_queus` ORDER BY `vehiclle_queus`.`timestamp` DESC
          //SELECT * FROM `vehiclle_queus` WHERE `stage` ='Nyeri '

          $r2 = mysqli_query($con,$sql);
          $result = array();
          while($row2 = mysqli_fetch_array($r2))
          {
            $postion = $row2['position'];
$destination="Unknown";
$number_plate = $row2['number_plate'];
$sql="SELECT * FROM `vehicle_locations`  where `number_plate` = '$number_plate' ";

//get_next_location($number_plate, $place_id);

$r0 = mysqli_query($con,$sql);
$count = mysqli_num_rows($r0);
if($count>0)
{
  while($row0 = mysqli_fetch_array($r0))
  {
  $current_location = $row0['current_locatiom'];
  }

}
else {
  $current_location ="Unknwon";

}
          ?>

                        <tr class="gradeY">

                            <td>
                                <?php echo $postion ?>
                            </td>
                            <td>
                                <?php echo $row2['number_plate'] ?> </td>
                            <td>
                                <?php echo $current_location ?>
                            </td>

                            <td>
                                <select id="next_destination">

                <?php

  $sql1="SELECT * FROM `stop_overs`";
  $ss = mysqli_query($con,$sql1);
  $count2 = mysqli_num_rows($ss);
  while ($mum= mysqli_fetch_array($ss))
  {

      $name = $mum['place_name'];
      if($name===$current_location)
      {

      }else
      {

            $count3=0;
            echo "<option value='".$name."'>".$name."</option>";


            $sql= "SELECT * FROM `departure_records` WHERE `number_plate` = '$number_plate' and `start_location` = '$place_id' and `stop_destination` = '$name' ";
            $s3 = mysqli_query($con,$sql);
            $count3 = mysqli_num_rows($s3);
            $res= "From ".$place_id." to ".$name." number of trips ".$count3;



      }
  }
              ?>

       </select>



                                <?php

  $sql1="SELECT * FROM `stop_overs`";
  $ss = mysqli_query($con,$sql1);
  $count2 = mysqli_num_rows($ss);
  while ($mum= mysqli_fetch_array($ss))
  {
$name = $mum['place_name'];
      if($name===$place_id)
      {

      }else
      {

            $count3=0;
            $sql= "SELECT * FROM `departure_records` WHERE `number_plate` = '$number_plate' and `start_location` = '$place_id' and `stop_destination` = '$name' ";
            $s3 = mysqli_query($con,$sql);
            $count3 = mysqli_num_rows($s3);
            $res= "From ".$place_id." to ".$name." number of trips ".$count3;

    ?>

       <div class="alert alert-success "> <a class="close" data-dismiss="alert" href="#">×</a>

    <?php echo   $res;    ?>
                                </div>

    <?php



      }
  }
              ?>                  </td>



                            <td>
                                <?php
$url_arrival="action.php?number_plate=".$number_plate."&current_location=".$place_id."&action=arrival_report";
$url_breakdown="action.php?number_plate=".$number_plate."&current_location=".$current_location."&action=breakdown_report";
$url_depart="action.php?number_plate=".$number_plate."&current_location=".$place_id."&action=departing_report"."&destination=";

 ?>
  <button class="btn btn-primary btn-block btn-mini" onclick="location.href='<?php echo $url_arrival ?>'"> Report Arival </button>
  <button class="btn btn-info btn-block btn-mini<?php if (strpos($current_location, " Vehicle ") === 0){echo ' disabled'; $url_breakdown ='#';}?>" onclick="location.href='<?php echo $url_breakdown?>'"> Report breakdown </button>
  <button class="btn btn-info btn-block btn-mini<?php
     if (strpos($current_location, " Vehicle ") === 0 || $current_location != $place_id )
     {
         echo ' disabled'; $url_depart ='#';

     }


else{

}
     ?>" onclick="gotonextevent()"> Depart </button>
                            </td>
                        </tr>
                        <?php
          }

          ?>
                </tbody>
            </table>
        </div>
    </div>


</div>


<script>
    function GetSelectedItem(el)
    {
        var e = document.getElementById(el);
        var strSel = "The Value is: " + e.options[e.selectedIndex].value + " and text is: " + e.options[e.selectedIndex].text;
        return e.options[e.selectedIndex].value;
    }



function gotonextevent()
{

  var selecteditem = GetSelectedItem('next_destination');
  console.log(selecteditem);
      var txt;
      var person = prompt('Please enter the number of passangers in the vehicle', '0');
      if (person == null || person == '')
      {
      }
      else
      {
     console.log('person '+person);
        var fare_per_person = prompt('Please enter the fare per person.', '0');
        if (fare_per_person == null || fare_per_person == '')
        {
        }
         else
        {
          console.log('fare per person '+fare_per_person);
          console.log('person '+person);

          console.log("url" + goto);
          var total_amt = fare_per_person*person;

var url = '<?php echo $url_depart; ?>';
var goto = url + selecteditem+'&totalamt='+total_amt;


        location.href =goto;
        }

      }




}



    var table = document.getElementById("table_click");
    if (table != null) {
        for (var i = 0; i < table.rows.length; i++) {
            for (var j = 0; j < table.rows[i].cells.length; j++)
                table.rows[i].cells[j].onclick = function() {
                    tableText(this);
                };
        }
    }

    function tableText(tableCell) {
      //  alert(tableCell.innerHTML);
    }

</script>

<?php
//a function to suggest next probable location!

include('connection.php');
function get_next_location($number_plate, $current_location)
{
  $viable_locations=array();
  $viable_locations_backub=array();

  $con = mysqli_connect('localhost', 'root', 'Wimme1234', 'kiemwasacco');
  $sql1="SELECT * FROM `stop_overs`";
  $ss = mysqli_query($con,$sql1);
  $count2 = mysqli_num_rows($ss);
  while ($mum= mysqli_fetch_array($ss))
  {
    $viable_locations[]= $mum['place_name'];
    $viable_locations_backub[]= $mum['place_name'];
  }

$vehicle_queuse_array = array();
$vehicle_number_plates = array();

$s0="SELECT * FROM `vehiclle_queus` WHERE `stage` ='$current_location' ORDER BY `vehiclle_queus`.`timestamp` ASC LIMIT 5";
$s = mysqli_query($con,$s0);
$count = mysqli_num_rows($s);
$int =0;

  while($rows= mysqli_fetch_array($s))
  {

    $vehicle_queuse_array[] = $rows['timestamp'];
    $vehicle_number_plates[] = $rows['number_plate'];

  }
  $s0="SELECT * FROM `vehiclle_queus` WHERE `stage` ='$current_location' ORDER BY `vehiclle_queus`.`timestamp` ASC LIMIT 5";
  $s = mysqli_query($con,$s0);
  $count = mysqli_num_rows($s);
  $int =0;
  while($rows= mysqli_fetch_array($s))
  {


    $current_vehicle = $rows['number_plate'];
    $sql1="SELECT * FROM `vehicle_locations` where `number_plate` = '$current_vehicle' LIMIT 1";
    $ss = mysqli_query($con,$sql1);
    $count2 = mysqli_num_rows($ss);
    if($count2>0)
    {
      while ($mum= mysqli_fetch_array($ss))
      {
        $vehicle_current_location= $mum['current_locatiom'];
      }
    }
    else
    {
    $vehicle_current_location= 'empty';
    }


    //echo $vehicle_current_location ."<br />";



if($vehicle_current_location!=$current_location)
{
echo "Vehicle not at the current location. Move on";
}
else
{
  echo $vehicle_number_plates[0];


}





    // $place_one=$vehicle_current_location[0];
    // $place_two=$vehicle_current_location[1];
    // $place_three=$vehicle_current_location[2];

    //GET ALL VIABLE LOCATIONS


    //print_r($viable_locations_backub);
    //    unset($array[1]);
    //

  // echo $place_one;
  // if($place_one===$current_location)
  // {
  // //the first vehicle in the queu is at already at the stage. so, its a no go zone. Skip!
  // //we get that location so that it wont be considered
  //   $sql="select * from `vehicle_locations` where  `number_plate` = '$vehicle_number_plates[0]'";
  //   $ss = mysqli_query($con,$sql1);
  //   while ($mum= mysqli_fetch_array($ss))
  //   {
  //     $next_location_for_location_one= $mum['next_location'];
  //   }
  //   //unset($viable_locations[1]);
  //  unset_array($viable_locations, $current_location);
  // }
  // if($place_two===$current_location)
  // {
  // //the first vehicle in the queu is at already at the stage. so, its a no go zone. Skip!
  // //we get that location so that it wont be considered
  //   $sql="select * from `vehicle_locations` where  `number_plate` = '$vehicle_number_plates[0]'";
  //   $ss = mysqli_query($con,$sql1);
  //   while ($mum= mysqli_fetch_array($ss))
  //   {
  //     $next_location_for_location_one= $mum['next_location'];
  //   }
  //   unset_array($viable_locations, $current_location);
  //
  // }
  // if($place_three===$current_location)
  // {
  // //the first vehicle in the queu is at already at the stage. so, its a no go zone. Skip!
  // //we get that location so that it wont be considered
  //   $sql="select * from `vehicle_locations` where  `number_plate` = '$vehicle_number_plates[0]'";
  //   $ss = mysqli_query($con,$sql1);
  //   while ($mum= mysqli_fetch_array($ss))
  //   {
  //     $next_location_for_location_one= $mum['next_location'];
  //   }
  //  unset_array($viable_locations, $current_location);
  //
  // }
   //print_r($viable_locations);

//    if(sizeof($viable_locations)===0)
//    {
//      //all locations have been booked!
//    }
//    else
//   {
//   //we only have these locations to choose from
//
//   for ($i=0; $i<sizeof($viable_locations);$i++)
//   {
//     $loc=$viable_locations[$i];
//     $sql ="SELECT * FROM `vehiclle_queus`  WHERE `stage` ='$loc' and `number_plate` =  '$number_plate'";
//     $r2 = mysqli_query($con,$sql);
//     $count = mysqli_num_rows($r2);
//     $post=$count;
//     $positions = array();
//     while($row2 = mysqli_fetch_array($r2))
//     {
//     $pos = $row2['position'];
//     $positions[]=$pos;
//
//     }
//   }
//
//
//   $res4 = max($positions);
//   $key = array_search($res4, $positions);
//   $next_location=$viable_locations[$key];
//
//   $update_sql="UPDATE `vehicle_locations` SET `next_location` = '$next_location' WHERE `vehicle_locations`.`number_plate` = '$number_plate'";
//   mysqli_query($con,$update_sql);
//
//   echo "<br />for vehicle with ".$number_plate." which is currently at  ".$current_location." we recommend it goes to ". $viable_locations[$key];
//
// }

}


 }



function unset_array($array_locations, $current_location)
{


$array_size = sizeof($array_locations);
for($i=0; $i<$array_size; $i++)
{

  if($current_location===$array_locations[$i])
  {

    unset($array_locations[$i]);
    array_values($array_locations);


  }

}
  return $viable_locations;
}



?>







    <?php include('footer.php');?>
