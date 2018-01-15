<?php

  $now = new \DateTime('now');
  $month = $now->format('m');
  $year = $now->format('Y');
  $now_month = $month;
  $month_from_db =  date('m', strtotime("2018-01-15 19:05:14"));


?>
